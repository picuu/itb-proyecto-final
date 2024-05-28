<script>
import 'leaflet/dist/leaflet.css'
import L from 'leaflet'

export default {
  name: 'MapComp',

  data() {
    return {
      location: {
        latitude: '',
        longitude: '',
        name: ''
      }
    }
  },
  methods: {
    initMap() {
      const map = L.map('map').setView([41.44163, 2.17727], 13)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map)

      const marker = L.marker([41.44163, 2.17727]).addTo(map)

      map.on('click', (e) => {
        const { lat, lng } = e.latlng
        marker.setLatLng(e.latlng)
        this.location.latitude = lat
        this.location.longitude = lng

        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
          .then((response) => response.json())
          .then((data) => {
            this.location.name = data.display_name
          })
          .catch((error) => console.error('Error fetching location name:', error))

        this.$emit('mapDataUpdate', this.location)
      })
    }
  },

  mounted() {
    this.initMap()
  }
}
</script>

<template>
  <div id="map" style="height: 400px"></div>
</template>

<style scoped></style>
