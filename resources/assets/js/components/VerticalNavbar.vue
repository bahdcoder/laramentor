<template>
  <div class="vertical-navbar">
      <div class="laramentor">LM</div>
      <ul class="menu">
          <router-link tag="li" to='/request-pool' class="menu-item">
              <i class="fas text-muted fa-list fa-2x menu-icon my-3"></i>
              <span class="menu-item-text">Pool</span>
          </router-link>
          <router-link tag="li" to='/pending' class="menu-item">
              <i class="fas text-muted fa-clock fa-2x menu-icon my-3"></i>
              <span class="menu-item-text">Pending</span>
          </router-link>
          <router-link tag="li" to='/progress' class="menu-item">
              <i class="fas text-muted fa-tasks fa-2x menu-icon my-3"></i>
              <span class="menu-item-text">In Progress</span>
          </router-link>
      </ul>
  </div>
</template>

<script>
export default {};
</script>

