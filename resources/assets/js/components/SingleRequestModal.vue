<template>
  <div class="modal" id="showSingleRequest" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" v-if="request">
        <div class="modal-header">
          <h5 class="modal-title">Request for {{ request.for }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button :disabled="!canShowInterest" type="button" @click="showInterest()" class="btn btn-primary">I'm interested</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "../event-bus";
import { SHOW_SINGLE_REQUEST, MENTORSHIP_REQUEST_UPDATED } from "../events";

export default {
  props: ["auth_id"],
  data() {
    return {
      request: null
    };
  },
  mounted() {
    EventBus.$on(SHOW_SINGLE_REQUEST, request => {
      this.request = request;
      $("#showSingleRequest").modal();
    });
  },
  methods: {
    showInterest() {
      axios
        .post(`/requests/${this.request.id}/interests`)
        .then(response => {
          EventBus.$emit(MENTORSHIP_REQUEST_UPDATED, response.data);

          this.$noty.success(
            "Successfully showed interest in this mentorship request."
          );
          $("#showSingleRequest").modal("hide");
        })
        .catch(error => {
          this.$noty.error("Something went wrong.");
        });
    }
  },
  computed: {
    canShowInterest() {
      return (
        this.request.user_id !== Number(this.auth_id) &&
        this.request.interests.findIndex(
          interest => interest.user_id === Number(this.auth_id)
        ) === -1
      );
    }
  }
};
</script>
