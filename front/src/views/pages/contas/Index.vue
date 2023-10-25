<script setup>
import { ref } from 'vue';
import UiParentCard from '@/components/shared/UiParentCard.vue';

</script>

<template>
    <v-row>
        <v-col cols="12" md="12">
            <UiParentCard title="Contas a pagar" to="/contas/pagar/adicionar"> 
              <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Valor</th>
                  <th>Emissao</th>
                  <th>Vencimento</th>
                  <th>Pagamento</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in items" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.titulo }}</td>
                  <td>{{ item.valor }}</td>
                  <td>{{ formatDate(item.emissao) }}</td>
                  <td>{{ formatDate(item.vencimento) }}</td>
                  <td>{{ item.pagamento ? formatDate(item.pagamento) : '' }}</td>
                  <td>
                    <button @click="editItem(item)">Editar</button>
                    <button @click="deleteItem(item)">Excluir</button>
                  </td>
                </tr>
              </tbody>
            </table>
            </UiParentCard>
        </v-col>
    </v-row>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    // Substitua 'SEU_TOKEN_AQUI' pelo token real de autorização
    const token = JSON.parse(localStorage.getItem("token"));
    // Defina a URL da sua API
    const apiUrl = `${import.meta.env.VITE_ENDPOIN}/contas/pagar`;

    // Dados a serem enviados na requisição POST (se necessário)
    const requestData = {
      // Coloque os dados que você deseja enviar na requisição POST
    };

    axios.get(apiUrl, {
      headers: {
        Authorization: `Bearer ${token.access_token}`,
      },
    })
    .then((response) => {
      // Preencha a tabela com os dados de resposta
      this.items = response.data.filter(item => item.excluido !== 1);
    })
    .catch((error) => {
      console.error('Erro na requisição:', error);
    });
  },
  methods: {
    editItem(item) {
      // Implemente a lógica de edição aqui
      this.$router.push(`/contas/pagar/editar/${item.id}`);
    },

    deleteItem(item) {
      // Pergunta ao usuário se ele tem certeza que deseja excluir
      const confirmation = window.confirm('Tem certeza que deseja excluir?');
      if (confirmation) {
        const token = JSON.parse(localStorage.getItem("token"));
        const apiUrl = `${import.meta.env.VITE_ENDPOIN}/contas/pagar/${item.id}`;

        const config = {
          headers: {
            'Authorization': `Bearer ${token.access_token}`,
          },
        };

        axios.delete(apiUrl, config)
          .then(response => {
            // A solicitação foi bem-sucedida
            console.log('Item excluído com sucesso.');

            // Redireciona o usuário para a página /contas/pagar após a exclusão
            window.location.reload();
          })
          .catch(error => {
            // Ocorreu um erro na solicitação
            console.error('Erro na solicitação DELETE:', error);
          });
      }
    },

    formatDate(date) {
      const options = { year: '2-digit', month: '2-digit', day: '2-digit' };
      const formattedDate = new Date(date).toLocaleDateString('pt-BR', options);
      return formattedDate;
    },
  },
};
</script>

<style>
/* Estilos CSS para a tabela (opcional) */
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

.table th {
  background-color: #f2f2f2;
}
</style>
<style>
/* Estilos CSS para a tabela (opcional) */
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

.table th {
  background-color: #f2f2f2;
}
</style>





