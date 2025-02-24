<template>
  <!-- Template do componente principal -->
</template>

<script>
  import { SpeedInsights } from "@vercel/speed-insights/vue"
  import { Analytics } from "@vercel/analytics/react"
  export default {
    name: 'App', // Nome do componente
  };

  SpeedInsights();
  Analytics();
</script>

<style>

</style>
