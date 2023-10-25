<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { router } from '@/router/index';

const endpoint = import.meta.env.VITE_ENDPOIN;
const checkbox = ref(false)
const email = ref("")
const senha = ref("")
const showAlert = ref(false);
const alertType = ref("");

function login() {


    let config = {
        method: 'post',
        maxBodyLength: Infinity,
        url: `${endpoint}/auth/login`,
        headers: { 
            'Content-Type': 'application/json'
        },
        data : JSON.stringify({
            "email": email.value,
            "password": senha.value
        })
    };

    axios.request(config)
    .then((response) => {
        alertType.value = "success";
        showAlert.value = true;
        localStorage.setItem('token', JSON.stringify(response.data));
        router.push({ name: 'Dashboard' });
    })

    .catch((error) => {
        alertType.value = "error";
        showAlert.value = true;
        console.log(error);
    });
}
</script>

<template>
    <div>
        <v-row class="mb-3">
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">E-mail</v-label>
                <v-text-field v-model="email" variant="outlined" class="pwdInput" hide-details color="primary"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-label class="font-weight-medium mb-1">Senha</v-label>
                <v-text-field v-model="senha" variant="outlined" class="border-borderColor" type="password" hide-details color="primary" ref="password"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-btn @click="login" size="large" rounded="pill" color="primary" class="rounded-pill" block type="submit" flat>Autenticar</v-btn>
            </v-col>
   
            <v-col v-if="showAlert" cols="12">
                <v-alert class="mb-3" :type="alertType">{{ alertType === 'success' ? 'Credenciais validadas, aguarde...' : 'E-mail ou senha incorreta.' }}</v-alert>
            </v-col>
            
        </v-row>
    </div>
</template>
