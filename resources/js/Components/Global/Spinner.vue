<template>
  <div class="spinner fixed top-0 left-0 w-full h-full bg-black bg-opacity-90 z-50">
      <ul>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
      </ul>
  </div>
</template>

<script setup>

</script>

<style scoped>
  .spinner ul {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
    padding: 0;
    display: flex;
  }
  .spinner ul li {
    list-style: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #fff;
    animation: grow 1.6s ease-in-out infinite;
  }

  /* Define animation */
  @keyframes grow {
    0%,
    40%,
    100% {
        transform: scale(0.2);
    }
    20% {
        transform: scale(1);
    }
  }

  /* Define li properties */
  .spinner ul li:nth-child(1) {
      animation-delay: -1.4s;
      background: #ffff00;
      box-shadow: 0 0 50px #ffff00;
  }
  .spinner ul li:nth-child(2) {
      animation-delay: -1.2s;
      background: #76ff03;
      box-shadow: 0 0 50px #76ff03;
  }
  .spinner ul li:nth-child(3) {
      animation-delay: -1s;
      background: #f06292;
      box-shadow: 0 0 50px #f06292;
  }
  .spinner ul li:nth-child(4) {
      animation-delay: -0.8s;
      background: #4fc3f7;
      box-shadow: 0 0 50px #4fc3f7;
  }
  .spinner ul li:nth-child(5) {
      animation-delay: -0.6s;
      background: #ba68c8;
      box-shadow: 0 0 50px #ba68c8;
  }
  .spinner ul li:nth-child(6) {
      animation-delay: -0.4s;
      background: #f57300;
      box-shadow: 0 0 50px #f57300;
  }
  .spinner ul li:nth-child(7) {
      animation-delay: -0.2s;
      background: #673ab7;
      box-shadow: 0 0 50px #673ab7;
  }
</style>