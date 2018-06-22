<template>
  <div class="mx-3 my-3">
    <div class="form-group">
      <h5 class="text-muted">Requests</h5>
      <div class="form-check my-2">
        <input class="form-check-input" type="radio" name="requests" id="myRequests" value="myRequests" checked>
        <label class="form-check-label" for="myRequests">
          My Requests
        </label>
      </div>
      <div class="form-check my-2">
        <input class="form-check-input" type="radio" name="requests" id="allRequests" value="myRequests">
        <label class="form-check-label" for="allRequests">
          All Requests
        </label>
      </div>
    </div>
    <div class="form-group">
      <h5 class="text-muted">Type</h5>
      <div class="form-check my-2">
        <input class="form-check-input" type="checkbox" value="" id="seekingMentor">
        <label class="form-check-label" for="seekingMentor">
          Seeking Mentor
        </label>
      </div>
      <div class="form-check my-2">
        <input class="form-check-input" type="checkbox" value="" id="seekingMentee">
        <label class="form-check-label" for="seekingMentee">
          Seeking Mentee
        </label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {}
};
</script>

