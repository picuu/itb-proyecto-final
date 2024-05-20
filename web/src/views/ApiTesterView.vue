<template>
  <div class="api-tester">
    <h1>API Tester</h1>
    
    <!-- Section for testing GET requests -->
    <section>
      <h2>GET Request</h2>
      <input v-model="getEndpoint" placeholder="Endpoint (e.g., user)">
      <button @click="testGetRequest">Send GET Request</button>
      <pre>{{ getResponse }}</pre>
    </section>

    <!-- Section for testing POST requests -->
    <section>
      <h2>POST Request</h2>
      <input v-model="postEndpoint" placeholder="Endpoint (e.g., user)">
      <textarea v-model="postData" placeholder="Request Body (JSON)"></textarea>
      <button @click="testPostRequest">Send POST Request</button>
      <pre>{{ postResponse }}</pre>
    </section>

    <!-- Section for testing PUT requests -->
    <section>
      <h2>PUT Request</h2>
      <input v-model="putEndpoint" placeholder="Endpoint (e.g., user/1)">
      <textarea v-model="putData" placeholder="Request Body (JSON)"></textarea>
      <button @click="testPutRequest">Send PUT Request</button>
      <pre>{{ putResponse }}</pre>
    </section>

    <!-- Section for testing DELETE requests -->
    <section>
      <h2>DELETE Request</h2>
      <input v-model="deleteEndpoint" placeholder="Endpoint (e.g., user/1)">
      <button @click="testDeleteRequest">Send DELETE Request</button>
      <pre>{{ deleteResponse }}</pre>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      getEndpoint: '',
      postEndpoint: '',
      putEndpoint: '',
      deleteEndpoint: '',
      postData: '',
      putData: '',
      getResponse: '',
      postResponse: '',
      putResponse: '',
      deleteResponse: '',
    };
  },
  methods: {
    async testGetRequest() {
      try {
        const response = await fetch(`/api/index.php/${this.getEndpoint}/`);
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.getResponse = JSON.stringify(data, null, 2);  // Formatea el JSON para mostrarlo mejor
      } catch (error) {
        this.getResponse = `Error: ${error.message}`;
      }
    },
    async testPostRequest() {
      try {
        const response = await fetch(`/api/index.php/${this.postEndpoint}/`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: this.postData,
        });
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.postResponse = JSON.stringify(data, null, 2);
      } catch (error) {
        this.postResponse = `Error: ${error.message}`;
      }
    },
    async testPutRequest() {
      try {
        const response = await fetch(`/api/index.php/${this.putEndpoint}/`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: this.putData,
        });
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.putResponse = JSON.stringify(data, null, 2);
      } catch (error) {
        this.putResponse = `Error: ${error.message}`;
      }
    },
    async testDeleteRequest() {
      try {
        const response = await fetch(`/api/index.php/${this.deleteEndpoint}/`, {
          method: 'DELETE',
        });
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.deleteResponse = JSON.stringify(data, null, 2);
      } catch (error) {
        this.deleteResponse = `Error: ${error.message}`;
      }
    },
  },
};
</script>

<style scoped>
.api-tester {
  padding: 20px;
  max-width: 600px;
  margin: 0 auto;
}
section {
  margin-bottom: 20px;
}
input, textarea {
  width: 100%;
  margin-bottom: 10px;
  padding: 10px;
  box-sizing: border-box;
}
button {
  padding: 10px 20px;
}
pre {
  background: #f0f0f0;
  color: black;
  padding: 10px;
  overflow-x: auto;
}
</style>
