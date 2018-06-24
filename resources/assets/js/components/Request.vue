<template>
    <div class="modal fade" id="request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Request for {{ type }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="skills">Select the skills you want to {{ type === 'Mentor' ? 'acquire' : 'share' }}</label>
                    <v-select multiple v-model="selectedSkills" label="name" :options="skills"></v-select>
                </div>
                <div class="form-group">
                    <label for="description">Give a clear description of your expectations</label>
                    <textarea v-model="description" name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <select v-model="duration" name="duration" id="duration" class="form-control">
                        <option value="1">1 Week</option>
                        <option value="2">2 Weeks</option>
                        <option value="3">3 Weeks</option>
                        <option value="4">4 Weeks</option>
                        <option value="5">5 Weeks</option>
                        <option value="6">6 Weeks</option>
                        <option value="7">7 Weeks</option>
                        <option value="8">8 Weeks</option>
                        <option value="9">9 Weeks</option>
                        <option value="10">10 Weeks</option>
                        <option value="11">11 Weeks</option>
                        <option value="12">12 Weeks</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="days">Days</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="monday" value="1">
                        <label class="text-muted form-check-label" for="monday">Monday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="tuesday" value="2">
                        <label class="text-muted form-check-label" for="tuesday">Tuesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="wednesday" value="3">
                        <label class="text-muted form-check-label" for="wednesday">Wednesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="thursday" value="4">
                        <label class="text-muted form-check-label" for="thursday">Thursday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="friday" value="5">
                        <label class="text-muted form-check-label" for="friday">Friday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="saturday" value="6">
                        <label class="text-muted form-check-label" for="saturday">Saturday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days" class="form-check-input" type="checkbox" id="sunday" value="7">
                        <label class="text-muted form-check-label" for="sunday">Sunday</label>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="pairing_time">Session Pairing Time</label>
                    <br>
                    <v-time-picker v-model="pairing_time" :config="pairing_time_options"></v-time-picker>
                </div>

                <div class="form-group">
                    <label for="session_duration">Session Pairing duration</label>
                    <br>
                    <select v-model="session_duration" name="session_duration" id="session_duration" class="form-control">
                        <option value="30">30 minutes</option>
                        <option value="60">1 hour</option>
                        <option value="90">1hour 30 minutes</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="alert alert-info" v-if="this.duration && this.pairingTimeIsValid() && this.days.length > 0">
                        {{ summaryMessage }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" :disabled="loading" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" @click="requestMentor()" :disabled="!isValidRequest || loading" class="btn btn-primary">
                    <i class="fas fa-spinner fa-spin" v-if="loading"></i>
                    <span v-else>Request {{ type }}</span>
                </button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from "vue-select";
import TimePicker from "vue-bootstrap-datetimepicker";

import "pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css";

import EventBus from "../event-bus";
import { SET_REQUEST_TYPE } from "../events";

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
  data() {
    return {
      type: "",
      selectedSkills: [],
      description: "",
      duration: null,
      days: [],
      description: "",
      pairing_time: new Date(),
      pairing_time_options: {
        format: "HH:mm",
        useCurrent: false
      },
      session_duration: 30,
      loading: false
    };
  },
  components: {
    "v-select": vSelect,
    "v-time-picker": TimePicker
  },
  props: ["skills"],
  mounted() {
    EventBus.$on(SET_REQUEST_TYPE, type => {
      this.type = type;
      $("#request").modal();
    });
  },
  computed: {
    isValidRequest() {
      const descriptionIsValid = () =>
        this.description && this.description.length > 10;
      const typeIsValid = () =>
        this.type === "Mentor" || this.type === "Mentee";
      const durationIsValid = () =>
        this.duration &&
        typeof Number(this.duration) === "number" &&
        Number(this.duration) < 12;
      const daysIsValid = () => this.days.length > 0;
      const skillsIsValid = () => this.selectedSkills.length > 0;

      return (
        descriptionIsValid() &&
        typeIsValid() &&
        durationIsValid() &&
        daysIsValid() &&
        skillsIsValid() &&
        this.pairingTimeIsValid()
      );
    },
    summaryMessage() {
      const occurence = this.days.sort().map(day => weekDays[day]);

      let occurenceString = "";

      occurence.forEach((day, index) => {
        if (index === 0) {
          occurenceString += day;
        } else if (index > 0 && index < occurence.length - 1) {
          occurenceString += `, ${day}`;
        } else {
          occurenceString += ` and ${day}.`;
        }
      });

      const message = `This mentorship will last for ${
        this.duration
      } weeks. Mentorship sessions will hold on ${occurenceString} at ${
        this.pairing_time
      }.`;

      return message;
    }
  },
  methods: {
    pairingTimeIsValid() {
      return /^(?:[01]\d|2[0-3]):[0-5]\d$/.test(this.pairing_time);
    },
    requestMentor() {
      this.loading = true;
      axios
        .post("/requests", {
          for: this.type.toLowerCase(),
          description: this.description,
          mentorship_duration: this.duration * 7, // database stores mentorship duration as number of days.
          pairing_time: this.pairing_time,
          skills: this.skills.map(skill => skill.id),
          session_duration: this.session_duration,
          days: this.days.join("")
        })
        .then(response => {
          this.$noty.success("Successfully published mentorship request.");

          this.resetData();
          $("#request").modal("hide");
        });
    },
    resetData() {
        this.type = '';
        this.selectedSkills = [];
        this.description = '';
        this.duration = null;
        this.days = [];
        this.pairing_time = new Date();
        this.pairing_time_options = {
            format: "HH:mm",
            useCurrent: false
        };
        session_duration: 30;
        loading: false
    }
  }
};
</script>
