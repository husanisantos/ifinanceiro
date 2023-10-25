<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="titulo">Título:</label>
          <input type="text" id="titulo" v-model="formulario.titulo" required />
        </div>
  
        <div>
          <label for="descricao">Descrição:</label>
          <textarea id="descricao" v-model="formulario.descricao"></textarea>
        </div>
  
        <div>
          <label for="emissao">Data de Emissão:</label>
          <input type="date" id="emissao" v-model="formulario.emissao" required />
        </div>
  
        <div>
          <label for="vencimento">Data de Vencimento:</label>
          <input type="date" id="vencimento" v-model="formulario.vencimento" />
        </div>
  
        <div>
          <label for="valor">Valor:</label>
          <input type="text" id="valor" v-model="formulario.valor" @input="formatarValor" required />
        </div>
  
        <button type="submit">Enviar</button>
      </form>
    </div>
  </template>
  
  <script>
  import Vuelidate from 'vuelidate';
  import { required, minValue } from 'vuelidate/lib/validators';
  
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
    validations: {
      formulario: {
        titulo: {
          required
        },
        descricao: {},
        emissao: {
          required
        },
        vencimento: {},
        valor: {
          required,
          minValue: minValue(0)
        }
      }
    },
    methods: {
      submitForm() {
        if (this.$v.formulario.$invalid) {
          alert('Por favor, preencha todos os campos obrigatórios corretamente.');
          return;
        }
  
        // Faça algo com os dados do formulário
        console.log('Dados do formulário:', this.formulario);
      },
      formatarValor() {
        // Formatar o valor monetário (exemplo simples)
        this.formulario.valor = this.formulario.valor
          .replace(/\D/g, '') // Remove todos os caracteres não numéricos
          .replace(/(\d)(\d{2})$/, '$1,$2'); // Adiciona a vírgula como separador de decimais
      }
    }
  };
  </script>