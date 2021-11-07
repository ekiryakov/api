<template>
  <v-form method="post" ref="form" v-model="valid">
    <v-container class="text-center">
      <v-btn-toggle rounded dense borderless mandatory v-model="userType">
        <v-btn href="/vendor/register">Vendor</v-btn>
        <v-btn href="/customer/register">Customer</v-btn>
      </v-btn-toggle>
    </v-container>
    <v-text-field
        v-model="email"
        :rules="emailRules"
        type="email"
        name="vendor_registration_form[email]"
        id="vendor_registration_form_email"
        label="Email"
        autocomplete="email"
        required
        autofocus>
    </v-text-field>
    <v-text-field
        v-model="name"
        :rules="nameRules"
        type="text"
        name="vendor_registration_form[name]"
        id="vendor_registration_form_name"
        label="Name"
        required>
    </v-text-field>
    <v-text-field
        v-model="logo"
        :rules="logoRules"
        type="url"
        name="vendor_registration_form[logo]"
        id="vendor_registration_form_logo"
        label="Logo"
        required>
    </v-text-field>
    <v-text-field
        v-model="plainPassword"
        :rules="passwordRules"
        type="password"
        name="vendor_registration_form[plainPassword]"
        id="vendor_registration_form_plainPassword"
        autocomplete="new-password"
        label="Password"
        required>
    </v-text-field>
    <v-checkbox
        v-model="agree"
        :rules="agreeRules"
        label="Agree terms"
        required>
    </v-checkbox>
    <v-text-field v-if="agree"
        class="ma-0 pa-0"
        name="vendor_registration_form[agreeTerms]"
        id="vendor_registration_form_agreeTerms"
        value="agree"
        type="hidden"
        hide-details="auto">
    </v-text-field>
    <v-text-field
        class="ma-0 pa-0"
        name="vendor_registration_form[_token]"
        id="vendor_registration_form__token"
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
      Register
    </v-btn>
    <v-btn
        outlined rounded x-large
        class="mb-1"
        href="/vendor/login">
      Sign in
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
    name: '',
    logo: '',
    plainPassword: '',
    agree: false,
    emailRules: [
      v => !!v || 'Email is required',
      v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Incorrect email',
    ],
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length >= 3) || 'Name must be more than 3 characters',
    ],
    logoRules: [
      v => !!v || 'Logo URL is required',
    ],
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length >= 6) || 'Password must be more than 6 characters',
    ],
    agreeRules: [
      v => !!v || 'You must agree to continue!',
    ],
  }),
}
</script>

<style scoped>

</style>