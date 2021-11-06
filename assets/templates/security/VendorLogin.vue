<template>
  <v-form method="post" ref="form" v-model="valid">
    <v-container class="text-center">
      <v-btn-toggle rounded dense borderless mandatory v-model="userType">
        <v-btn href="/vendor/login">Vendor</v-btn>
        <v-btn href="/customer/login">Customer</v-btn>
      </v-btn-toggle>
    </v-container>
    <v-text-field
        v-model="email"
        :rules="emailRules"
        type="email"
        name="email"
        id="inputEmail"
        autocomplete="email"
        label="Email"
        required
        autofocus>
    </v-text-field>
    <v-text-field
        v-model="password"
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
        label="Remember me"
        required>
    </v-checkbox>
    <v-text-field v-if="remember_me"
        class="ma-0 pa-0"
        name="_remember_me"
        value="remember"
        type="hidden"
        hide-details="auto">
    </v-text-field>
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
        color="success">
      Sign in
    </v-btn>
    <v-btn
        outlined rounded x-large
        class="mb-1"
        href="/vendor/register">
      Register
    </v-btn>
  </v-form>
</template>

<script>
export default {
  props: {
    csrf_token: String,
  },
  data: () => ({
    valid: false,
    userType: null,
    email: '',
    password: '',
    remember_me: true,
    emailRules: [
      v => !!v || 'Email is required',
      v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Incorrect email',
    ],
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length >= 6) || 'Password must be more than 6 characters',
    ],
  }),
}
</script>

<style scoped>

</style>