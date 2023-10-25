<template>
    <div>
      <v-row>
        <v-col cols="12" md="12">
          <UiParentCard title="Contas a pagar" to="/contas/pagar">
            <vue-good-table :columns="columns" :rows="contasAPagar" :pagination-options="paginationOptions">
              <template v-slot:table-row="props">
                <td>{{ props.row['titulo'] }}</td>
                <td>{{ props.row['valor_formatado'] }}</td>
                <td>{{ formatDate(props.row['emissao']) }}</td>
                <td>{{ formatDate(props.row['vencimento']) }}</td>
              </template>
            </vue-good-table>
            <button @click="downloadCSV">Download CSV</button>
          </UiParentCard>
        </v-col>
      </v-row>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import Axios from 'axios';
  import VueGoodTable from 'vue-good-table';
  import papaparse from 'papaparse';
  
  const contasAPagar = ref([]);
  const authToken = JSON.parse(localStorage.getItem('token'))
  
  const columns = [
    {
      label: 'Título',
      field: 'titulo',
    },
    {
      label: 'Valor Formatado',
      field: 'valor_formatado',
    },
    {
      label: 'Emissão',
      field: 'emissao',
    },
    {
      label: 'Vencimento',
      field: 'vencimento',
    },
  ];
  
  const paginationOptions = {
    enabled: true,
    perPage: 10,
    perPageDropdown: [10, 25, 50, 100],
  };

  
  onMounted(async () => {
    try {
      const response = await Axios.get('http://127.0.0.1:8000/api/v1/contas/pagar', {
        headers: {
          Authorization: `Bearer ${authToken.access_token}`,
        },
      });
      contasAPagar.value = response.data;
    } catch (error) {
      console.error('Erro ao buscar os dados da API:', error);
    }
  });
  
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString();
  }
  
  function downloadCSV() {
    const csvData = papaparse.unparse(contasAPagar.value, {
      header: true,
    });
    const blob = new Blob([csvData], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.setAttribute('download', 'contas_a_pagar.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  console.log(contasAPagar);
  </script>
  
  <style>
  /* Adicione estilos CSS aqui para personalizar a tabela e o botão */
  </style>
  