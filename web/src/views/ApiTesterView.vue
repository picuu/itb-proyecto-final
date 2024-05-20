<template>
  <div class="api-tester">
    <h1>API Tester</h1>
    
    <!-- Section for testing GET requests -->
    <section>
      <h2>GET Request</h2>
      <input v-model="getEndpoint" placeholder="Endpoint (e.g., empresa)">
      <button @click="testGetRequest">Send GET Request</button>
      <pre>{{ getResponse }}</pre>
    </section>

    <!-- Section for testing POST requests -->
    <section>
      <h2>POST Request</h2>
      <input v-model="postEndpoint" placeholder="Endpoint (e.g., empresa)">
      <textarea v-model="postData" placeholder="Request Body (JSON)"></textarea>
      <button @click="testPostRequest">Send POST Request</button>
      <pre>{{ postResponse }}</pre>
    </section>

    <!-- Section for testing PUT requests -->
    <section>
      <h2>PUT Request</h2>
      <input v-model="putEndpoint" placeholder="Endpoint (e.g., empresa/1)">
      <textarea v-model="putData" placeholder="Request Body (JSON)"></textarea>
      <button @click="testPutRequest">Send PUT Request</button>
      <pre>{{ putResponse }}</pre>
    </section>

    <!-- Section for testing DELETE requests -->
    <section>
      <h2>DELETE Request</h2>
      <input v-model="deleteEndpoint" placeholder="Endpoint (e.g., empresa/1)">
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
        const response = await fetch(`http://localhost:8000/${this.getEndpoint}`);
        this.getResponse = await response.json();
      } catch (error) {
        this.getResponse = `Error: ${error.message}`;
      }
    },
    async testPostRequest() {
      try {
        const response = await fetch(`http://localhost:8000/${this.postEndpoint}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: this.postData,
        });
        this.postResponse = await response.json();
      } catch (error) {
        this.postResponse = `Error: ${error.message}`;
      }
    },
    async testPutRequest() {
      try {
        const response = await fetch(`http://localhost:8000/${this.putEndpoint}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: this.putData,
        });
        this.putResponse = await response.json();
      } catch (error) {
        this.putResponse = `Error: ${error.message}`;
      }
    },
    async testDeleteRequest() {
      try {
        const response = await fetch(`http://localhost:8000/${this.deleteEndpoint}`, {
          method: 'DELETE',
        });
        this.deleteResponse = await response.json();
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
  padding: 10px;
  overflow-x: auto;
}
</style>