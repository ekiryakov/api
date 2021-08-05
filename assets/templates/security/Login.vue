<template>
  <v-form method="post" ref="form" v-model="valid" lazy-validation>

    <h1 class="display-4">Please sign in</h1>

    <input name="_csrf_token" value="${csrf_token}$" type="hidden"/>

    <v-text-field
        v-model="email"
        :rules="emailRules"
        :value="last_username"
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

    <v-btn
        :disabled="!valid"
        type="submit"
        color="success"
        @click="validate">
      Sign in
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
    password: '',
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length <= 10) || 'Password must be less than 10 characters',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
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