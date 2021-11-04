<template>
  <v-form method="post" ref="form" v-model="valid" lazy-validation>
    <v-btn-toggle rounded dense borderless mandatory v-model="userType">
      <v-btn href="/customer/login">Customer</v-btn>
      <v-btn href="/vendor/login">Vendor</v-btn>
    </v-btn-toggle>
    <v-text-field
        v-model="phone_number"
        :value="last_username"
        type="text"
        name="phone_number"
        id="inputPhoneNumber"
        autocomplete="email"
        label="Email"
        required
        autofocus>
    </v-text-field>
    <v-text-field
        v-model="password"
        :counter="10"
        :rules="passwordRules"
        type="password"
        name="password"
        id="inputPassword"
        autocomplete="current-password"
        label="Password"
        required>
    </v-text-field>
    <v-checkbox
        v-model="remember_me"
        name="_remember_me"
        label="Remember me">
    </v-checkbox>
    <v-text-field
        name="_csrf_token"
        :value="csrf_token"
        type="hidden"
        hide-details="auto">
    </v-text-field>
    <v-btn
        rounded x-large
        :disabled="!valid"
        class="mb-1 mr-1"
        type="submit"
        color="success"
        @click="validate">
      Sign in
    </v-btn>
    <v-btn
        outlined rounded x-large
        class="mb-1"
        href="/customer/register">
      Register
    </v-btn>
  </v-form>
</template>

<script>
export default {
  props: {
    csrf_token: String,
    last_username: String,
  },
  data: () => ({
    valid: true,
    userType: null,
    password: '',
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length <= 10) || 'Password must be less than 10 characters',
    ],
    phone_number: '',
    remember_me: true,
  }),

  methods: {
    validate () {
      this.$refs.form.validate()
    },
  },
}
</script>

<style scoped>

</style>