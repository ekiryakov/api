import Vue from "vue";
import FormData from "form-data";
import axios from "axios";

Vue.component('profile', async function (resolve) {
    const response = await fetch('/customer/1/edit');
    const form = await response.text();

    await resolve({
        data: () => ({
            success: false,
            successMessage: '',
            warning: false,
            warningMessage: '',
            error: false,
            errorMessage: '',
            resolve: null,
            reject: null,
            confirmation: false,
            cardRefund: null,
            comment: null,
            token: null,
            transition: null,
            confirmationTitle: '',
            confirmationQuestion: '',
        }),
        template: '<div>' +
            '<v-alert :value="success" dismissible type="success" transition="scale-transition">{{ successMessage }}</v-alert>' +
            '<v-alert :value="warning" dismissible type="warning" transition="scale-transition">{{ warningMessage }}</v-alert>' +
            '<v-alert :value="error" dismissible type="error" transition="scale-transition">{{ errorMessage }}</v-alert>' +
            form +
            '</div>',
        mounted() {
            let self = this;
            this.$refs.editForm.$on('submit', async function (e) {
                self.confirmationTitle = '';
                self.confirmationQuestion = '';
                switch (self.transition) {
                    case 'skip':
                        self.confirmationTitle = 'Откладывание платежа';
                        self.confirmationQuestion = 'Вы действительно хотите отложить платеж?';
                        break;
                    case 'refund':
                        self.confirmationTitle = 'Возвращение платежа';
                        self.confirmationQuestion = 'Вы действительно хотите вернуть платеж?';
                        break;
                    default: break;
                }
                e.preventDefault();
                if (await self.onApprove()) self.onExecute(e.target)
                else self.confirmation = false;
            })
        },
        methods: {
            approve() {
                this.resolve(true);
                this.confirmation = false;
            },
            disapprove() {
                this.resolve(false);
                this.confirmation = false;
            },
            async onApprove() {
                this.confirmation = true;
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                })
            },
            onExecute(target) {
                const form = new FormData(target);

                let self = this;

                axios.post('/customer/1/edit', form, {
                    headers: { 'content-type': 'application/x-www-form-urlencoded' }
                })
                .then(function (response) {
                    self.success = false;
                    self.warning = false;
                    self.error = false;
                    switch (response.data.code) {
                        case 200:
                            self.success = true;
                            self.successMessage = response.data.message;
                            setTimeout(() => { location.reload() }, 1500);
                            break;
                        case 304:
                            self.warning = true;
                            self.warningMessage = response.data.message;
                            setTimeout(() => { location.reload() }, 1500);
                            break;
                        case 422:
                            self.warning = true;
                            self.warningMessage = response.data.message;
                            break;
                        case 503:
                            self.error = true;
                            self.errorMessage = response.data.message;
                            break;
                        default: break;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
    });
});
