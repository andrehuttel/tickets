<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import $ from 'jquery';
import axios from 'axios';
import { ref } from 'vue';

const form = useForm({
    name: '',
    surname: '', 
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    phone: '', 
    country: 'Brasil', 
    cpf: '', 
    document: '', 
});

$(document).ready(function() {
    const foneInput = $('#phone');
    const cpfInput = $('#cpf');

    foneInput.on('input', function() {
        const numericValue = this.value.replace(/\D/g, '');
        const formattedValue = formatPhoneNumber(numericValue);
        this.value = formattedValue;
    });

    cpfInput.on('input', function() {
        const numericValue = this.value.replace(/\D/g, '');
        const formattedValue = formatCPF(numericValue);
        this.value = formattedValue;
    });

    function formatPhoneNumber(phoneNumber) {
        if (!phoneNumber) return '';
        if (phoneNumber.length <= 2) {
            return '(' + phoneNumber;
        } else if (phoneNumber.length <= 7) {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2);
        } else if (phoneNumber.length <= 10) {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2, 4) + '-' + phoneNumber.substr(6);
        } else {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2, 5) + '-' + phoneNumber.substr(7);
        }
    }

    function formatCPF(cpf) {
        if (!cpf) return '';

        // Remove caracteres não numéricos
        const numericValue = cpf.replace(/\D/g, '');

        // Formata o CPF
        if (numericValue.length <= 3) {
            return numericValue;
        } else if (numericValue.length <= 6) {
            return numericValue.substr(0, 3) + '.' + numericValue.substr(3);
        } else if (numericValue.length <= 9) {
            return numericValue.substr(0, 3) + '.' + numericValue.substr(3, 3) + '.' + numericValue.substr(6);
        } else {
            return numericValue.substr(0, 3) + '.' + numericValue.substr(3, 3) + '.' + numericValue.substr(6, 3) + '-' + numericValue.substr(9);
        }
    }
});

const emailValid = ref('');
const cpfValid = ref('');

function validateEmail() {
    axios.get(route('api.uniqueEmail'), { params: { email: form.email } })
        .then(response => {
            console.log(response.data.message);
            if (response.data.message == 'Usuário existe.'){
                emailValid.value = 'E-mail já cadastrado.';
            }
        })
        .catch(error => {
            if(error.response.status == 422){
                emailValid.value = 'E-mail Inválido.';
            }

            if(error.response.status == 404){
                emailValid.value = '';
            }
            //emailValid.value = '';
        });
}

function validateCPF() {
    axios.get(route('api.uniqueCpf'), { params: { cpf: form.cpf } })
        .then(response => {
            console.log(response.data.message);
            if (response.data.message == 'Usuário existe.'){
                cpfValid.value = 'CPF já cadastrado.';
            }
        })
        .catch(error => {
            if(error.response.status == 422){
                cpfValid.value = 'CPF Inválido.';
            }
            if(error.response.status == 404){
                cpfValid.value = '';
            }
        });
}

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <div class="font-bold text-xl text-center mb-4">Criar Conta</div>
        <form @submit.prevent="submit">
            <InertiaForm :data="form" method="post" :action="route('register')">
            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                    @blur="validateEmail"
                />
                <InputError class="mt-2" :message="emailValid" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Nome" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="surname" value="Sobrenome" />
                <TextInput
                    id="surname"
                    v-model="form.surname"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.surname" />
            </div>

            <div class="mt-4">
                <InputLabel for="country" value="País" />
                <select id="country" v-model="form.country" class="mt-1 block w-full">
                    <option value="Brasil">Brasil</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Paraguai">Paraguai</option>
                    <option value="Uruguai">Uruguai</option>
                    <option value="Chile">Chile</option>
                    <option value="EUA">EUA</option>
                    <option value="Canada">Canadá</option>
                </select>
            </div>

            <div class="mt-4" v-if="form.country === 'Brasil'">
                <InputLabel for="cpf" value="CPF" />
                <TextInput
                    id="cpf"
                    v-model="form.cpf"
                    type="text"
                    class="mt-1 block w-full"
                    maxlength="14"
                    required
                    @blur="validateCPF"
                />
                <InputError class="mt-2" :message="cpfValid" />
            </div>

            <div class="mt-4" v-else>
                <InputLabel for="document" value="Documento" />
                <TextInput
                    id="document"
                    v-model="form.document"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.document" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Celular" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="mt-1 block w-full"
                    autofocus
                    autocomplete="phone"
                    maxlength="15"
                    inputmode="numeric"
                />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Senha" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmar Senha" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            Ao continuar você concorda com nossos <a target="_blank" :href="route('footer.showTermsOfUse')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Termos de Uso</a> e <a target="_blank" :href="route('footer.showPrivacyPolicy')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Política de Privacidade</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-between mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Já possui conta? Faça login
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Continuar
                </PrimaryButton>
            </div>
        </InertiaForm>
        </form>
    </AuthenticationCard>
</template>
