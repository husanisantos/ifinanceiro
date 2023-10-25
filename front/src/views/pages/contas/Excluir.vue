<template>

  <v-row>
        <v-col cols="12" md="12">
            <UiParentCard title="Adicionar conta a pagar"> 
              <form @submit.prevent="submitForm">
                <v-row>

                  <v-col cols="12">
                    <v-label for="titulo" class="font-weight-medium mb-1">Título</v-label>
                    <v-text-field id="titulo" v-model="formulario.titulo" variant="outlined" class="pwdInput" color="primary" required></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-label for="descricao" class="font-weight-medium mb-1">Descrição</v-label>
                    <v-text-field id="descricao" v-model="formulario.descricao" variant="outlined" class="pwdInput" color="primary"></v-text-field>
                  </v-col>
          
                  <v-col cols="6">
                    <v-label for="emissao" class="font-weight-medium mb-1">Data de emissão</v-label>
                    <v-text-field type="date" id="emissao" v-model="formulario.emissao" variant="outlined" class="pwdInput" color="primary" required></v-text-field>
                  </v-col>

                  <v-col cols="6">
                    <v-label for="vencimento" class="font-weight-medium mb-1">Data de vencimento</v-label>
                    <v-text-field type="date" id="vencimento" v-model="formulario.vencimento" variant="outlined" class="pwdInput" color="primary"></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-label for="pagamento" class="font-weight-medium mb-1">Data de pagamento</v-label>
                    <v-text-field type="date" id="pagamento" v-model="formulario.pagamento" variant="outlined" class="pwdInput" color="primary"></v-text-field>
                  </v-col>
              
                  <v-col cols="12">
                    <v-label for="valor" class="font-weight-medium mb-1">Valor</v-label>
                    <v-text-field id="valor" @input="formatarValor" v-model="formulario.valor" variant="outlined" class="pwdInput" color="primary" required></v-text-field>
                  </v-col>

                  <v-col cols="12">
                        <v-btn type="submit" size="large" rounded="pill" color="primary" class="rounded-pill" block flat>Adicionar</v-btn>
                  </v-col>

                </v-row>
              </form>
            </UiParentCard>
        </v-col>
    </v-row>

  </template>
  
  <script setup>
    import { ref } from 'vue';
    import UiParentCard from '@/components/shared/UiParentCard.vue';
    import axios from 'axios';
  </script>

  <script>
  const endpoint = import.meta.env.VITE_ENDPOIN;
  export default {
    data() {
      return {
        formulario: {
          titulo: '',
          descricao: '',
          emissao: '',
          vencimento: '',
          pagamento: '',
          valor: ''
        }
      };
    },
    methods: {
      async submitForm() {
        const url = `${endpoint}/contas/pagar`;
        const token = JSON.parse(localStorage.getItem('token')); 

        const formData = {};
        
        for (const key in this.formulario) {
          if (this.formulario[key]) {
            formData[key] = this.formulario[key];
          }
        }
 
        try {
          const response = await axios.post(url, formData, {
            headers: {
              'Authorization': `Bearer ${token.access_token}`
            }
          });

          // A resposta da solicitação está em response.data
          console.log('Resposta da solicitação:', response.data);

          // Se a solicitação for bem-sucedida, redirecione para a rota desejada
          this.$router.push('/contas/pagar');
        } catch (error) {
          // Se houver um erro na solicitação, você pode lidar com ele aqui
          console.error('Erro na solicitação:', error);
        }
      },
      formatarValor() {
        // Formatar o valor monetário (exemplo simples)
        this.formulario.valor = this.formulario.valor
          .replace(/\D/g, '') // Remove todos os caracteres não numéricos
          .replace(/(\d)(\d{2})$/, '$1.$2'); // Adiciona a vírgula como separador de decimais
      }
    }
  };
  </script>