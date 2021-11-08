<template>
  <v-form method="post" ref="form" v-model="valid">
    <v-container class="text-center">
      <v-btn-toggle rounded dense borderless mandatory v-model="userType">
        <v-btn href="/customer/register">Customer</v-btn>
        <v-btn href="/vendor/register">Vendor</v-btn>
      </v-btn-toggle>
    </v-container>
    <v-text-field
        v-model="phone_number"
        :rules="phoneRules"
        type="tel"
        name="customer_registration_form[phone_number]"
        id="customer_registration_form_phone_number"
        label="Phone number"
        required
        autofocus>
    </v-text-field>
    <v-text-field
        v-model="email"
        :rules="emailRules"
        type="email"
        name="customer_registration_form[email]"
        id="customer_registration_form_email"
        label="Email"
        autocomplete="email"
        required>
    </v-text-field>
    <v-text-field
        v-model="name"
        :rules="nameRules"
        type="text"
        name="customer_registration_form[name]"
        id="customer_registration_form_name"
        label="Name"
        required>
    </v-text-field>
    <v-text-field
        v-model="plainPassword"
        :rules="passwordRules"
        type="password"
        name="customer_registration_form[plainPassword]"
        id="customer_registration_form_plainPassword"
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
        name="customer_registration_form[agreeTerms]"
        id="customer_registration_form_agreeTerms"
        value="agree"
        type="hidden"
        hide-details="auto">
    </v-text-field>
    <v-text-field
        class="ma-0 pa-0"
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
    data: String,
  },
  data: () => ({
    form: null,
    valid: false,
    userType: null,
    phone_number: '',
    email: '',
    name: '',
    plainPassword: '',
    agree: false,
    phoneRules: [
      v => !!v || 'Phone number is required',
      v => /^\d{10}$/.test(v) || 'Incorrect phone number',
    ],
    emailRules: [
      v => !!v || 'Email is required',
      v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Incorrect email',
    ],
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length >= 3) || 'Name must be more than 3 characters',
    ],
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length >= 6) || 'Password must be more than 6 characters',
    ],
    agreeRules: [
      v => !!v || 'You must agree to continue!',
    ],
  }),
  mounted() {
    this.form = JSON.parse(this.data);
    
    this.phone_number = this.form.phoneNumber || '';
    this.email = this.form.email || '';
    this.name = this.form.name || '';
  },
}
</script>

<style scoped>

</style>