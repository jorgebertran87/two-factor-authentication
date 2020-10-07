<template>
  <div id="app">
    <form>
      <h3>Two-factor authenticator</h3>
      <input style="width: 100px" v-model="phoneNumber" type="text" placeholder="Phone Number" />
      <input style="width: 100px" v-model="code" type="text" placeholder="Master code" /><br />
      <input style="width: 100px" type="button" @click="retrieveVerificationInfo" value="Retrieve" />
      <input style="width: 100px" type="button" @click="checkVerificationInfo" value="Check" /><br />
      <div style="border: solid 1px #ccc; padding: 10px; margin-top: 10px">
        <span><b>Verification Id:</b> {{verificationId}}</span><br />
        <span><b>Code:</b> {{code}}</span><br />
        <span><b>Valid:</b> {{valid ? 'Yes!' : ( valid === null ? '' : 'No!' )}}</span>
      </div>
    </form>
  </div>
</template>

<script>
const URL =  'http://0.0.0.0';
const VERIFICATIONS_ENDPOINT = URL + '/verifications';
import axios from "axios";
export default {
  name: 'app',
  data () {
    return {
      phoneNumber: '',
      verificationId: '',
      code: '',
      valid: null
    }
  },
  methods: {
    retrieveVerificationInfo() {
      const params = {
        phoneNumber: this.phoneNumber
      };
      const promise = axios.post(VERIFICATIONS_ENDPOINT, params);
      return promise.then((response) => {
          const data = response.data;
          this.verificationId = data.verificationId;
          this.code = data.code;
      }).catch((error) => {
        alert(error.response.data);
      });
    },
    checkVerificationInfo() {
      const url = VERIFICATIONS_ENDPOINT + '/' + this.verificationId;
      const params = {
        code: this.code
      };
      const promise = axios.post(url, params);
      return promise.then((response) => {
          this.valid  = response.data;
      }).catch((error) =>  {
        this.valid  = error.response.data;
      });
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  color: #2c3e50;
  margin: 60px auto 0 auto;
  width: 50%;
  text-align: left;
}

input {
  border: solid 1px;
  padding: 5px;
  margin-bottom: 5px
}

input[type=button] {
  cursor: pointer;
}
</style>
