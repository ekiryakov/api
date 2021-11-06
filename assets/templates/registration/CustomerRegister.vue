<template>
  <v-form method="post" ref="form" v-model="valid" @submit="checkForm">
    <v-container class="text-center">
      <v-btn-toggle rounded dense borderless mandatory v-model="userType">
        <v-btn href="/customer/register">Customer</v-btn>
        <v-btn href="/vendor/register">Vendor</v-btn>
      </v-btn-toggle>
    </v-container>
    <v-text-field
        v-model="phone_number"
        type="tel"
        name="customer_registration_form[phone_number]"
        id="customer_registration_form_phone_number"
        label="Phone number"
        required
        autofocus>
    </v-text-field>
    <v-text-field
        v-model="email"
        type="email"
        name="customer_registration_form[email]"
        id="customer_registration_form_email"
        label="Email"
        required>
    </v-text-field>
    <v-text-field
        v-model="name"
        type="text"
        name="customer_registration_form[name]"
        id="customer_registration_form_name"
        label="Name"
        required>
    </v-text-field>
    <v-text-field
        v-model="plainPassword"
        :counter="10"
        :rules="passwordRules"
        type="password"
        name="customer_registration_form[plainPassword]"
        id="customer_registration_form_plainPassword"
        autocomplete="new-password"
        label="Password"
        required>
    </v-text-field>
    <v-checkbox
        v-model="agreeTerms"
        :checked="isAgree"
        :rules="agreeTermsRules"
        @change="changeAgree"
        true-value="1"
        false-value="0"
        type="checkbox"
        name="customer_registration_form[agreeTerms]"
        id="customer_registration_form_agreeTerms"
        label="Agree terms"
        required>
    </v-checkbox>
    <v-text-field
        name="customer_registration_form[_token]"
        id="customer_registration_form__token"
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
        href="/customer/login">
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
    plainPassword: '',
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length <= 10) || 'Password must be less than 10 characters',
    ],
    agreeTermsRules: [v => !!v || 'You must agree to continue!'],
    phone_number: '',
    email: '',
    name: '',
    agreeTerms: true,
    isAgree: false,
  }),
  computed: {
    isAgree: () => {
      return this !== undefined ? this.isAgree = !this.isAgree : false;
    }
  },
  methods: {
    changeAgree () {
      this.isAgree = !this.isAgree;
    },
    checkForm () {
      return true;
    }
  }
}
</script>

<style scoped>

</style>