<template>
    <div>
        <div class="text-center" v-if="loading">
            <i class="fas  fa-2x fa-spinner fa-spin"></i>
        </div>
        <table v-else class="table request-pool">
            <thead>
                <tr>
                    <th scope="col">Request For</th>
                    <th scope="col">Skills</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Pairing days</th>
                    <th scope="col">Interests</th>
                    <th scope="col">Date Added</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request in requests" :key="request.id" @click="showSingleRequest(request)">
                    <td>{{ request.for }}</td>
                    <td>{{ getRequestSkills(request) }}</td>
                    <td>{{ request.mentorship_duration }} days</td>
                    <td>{{ getRequestDays(request) }}</td>
                    <td>{{ request.interests.length }}</td>
                    <td>{{ (new Date(request.created_at)).toDateString() }}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>

<script>
import EventBus from "../event-bus";
import { SHOW_SINGLE_REQUEST, MENTORSHIP_REQUEST_UPDATED } from "../events";

const weekDays = {
  1: "Mondays",
  2: "Tuesdays",
  3: "Wednesdays",
  4: "Thursdays",
  5: "Fridays",
  6: "Saturdays",
  7: "Sundays"
};

export default {
  props: ["initial_requests"],
  data() {
    return {
      requests: this.initial_requests,
      loading: true
    };
  },
  mounted() {
    EventBus.$on(MENTORSHIP_REQUEST_UPDATED, request => {
      console.log("@@22", request);
      const requestIndex = this.requests.findIndex(
        element => element.id === request.id
      );

      this.requests.splice(requestIndex, 1, request);
    });

    this.fetchRequests();
  },
  computed: {},
  methods: {
    getRequestSkills(request) {
      let requestString = request.skills.map(skill => skill.name).toString();

      if (requestString.length > 24) {
        requestString = `${requestString.substring(0, 24)}...`;
      }

      return requestString;
    },
    getRequestDays(request) {
      return String(request.days)
        .split("")
        .map(day => ` ${weekDays[day]}`)
        .toString();
    },
    showSingleRequest(request) {
      EventBus.$emit(SHOW_SINGLE_REQUEST, request);
    },
    fetchRequests() {
      axios.get("/requests").then(response => {
        this.requests = response.data;
        this.loading = false;
      });
    }
  }
};
</script>

<style>
tr {
  cursor: pointer;
}
</style>

