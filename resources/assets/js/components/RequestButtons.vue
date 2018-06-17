<template>
  <div class="dropdown mr-5">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Request for
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <button class="dropdown-item" @click="setRequestType('Mentor')">MENTOR</button>
      <button class="dropdown-item" @click="setRequestType('Mentee')">MENTEE</button>
    </div>
  </div>
</template>

<script>
import EventBus from '../event-bus'
import { SET_REQUEST_TYPE } from '../events'

export default {
  methods: {
    setRequestType(type) {
      EventBus.$emit(SET_REQUEST_TYPE, type)
    }
  }
}
</script>

