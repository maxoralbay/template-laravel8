import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';

import InputMask from 'primevue/inputmask';
import Password from 'primevue/password';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Toast from 'primevue/toast';
import Button from 'primevue/button';
import Chart from 'primevue/chart';
import Calendar from 'primevue/calendar';

import 'primevue/resources/themes/saga-green/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

export default function ({app}) {
    app.use(PrimeVue);
    app.use(ToastService)

    app.component('InputMask', InputMask)
    app.component('InputText', InputText)
    app.component('InputNumber', InputNumber)
    app.component('Password', Password)
    app.component('Toast', Toast)
    app.component('Button', Button)
    app.component('Chart', Chart)
    app.component('Calendar', Calendar)
}