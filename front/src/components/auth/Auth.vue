<script>

import axios from 'axios';

const endpoint = import.meta.env.VITE_ENDPOIN;

const Auth = {
  check: async () => {

    const token = JSON.parse(localStorage.getItem('token'));
    
    try {
      const response = await axios.post(`${endpoint}/auth/check`, {}, {
        headers: {
          Authorization: `Bearer ${token.access_token}`,
        }
      });

      if (response.status === 200) {
        return true;
      } else {
        return false;
      }
    } catch (error) {
      console.error('Ocorreu um erro na solicitação:', error);
      return false;
    }

  },

  token: () => {
    // Verifica se o token foi criado
    const token = localStorage.getItem('token');
    // Responde com o Token se o mesmo existe
    if (token) {
      return token;
    }
    // Responde com false se não existir o token
    return false;
  }
};

export default Auth;


</script>