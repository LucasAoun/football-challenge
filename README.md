# Football App

## Instalação

1. Clone este repositório:

   ```bash
   git clone https://github.com/LucasAoun/football-app.git

2. Acesse o diretorio do projeto e execute o seguinte comando para instalar as dependências do Composer:
   ```bash
   composer install
   
3. Gere uma chave de aplicação
   ```bash
   php artisan key:generate

4. Crie um arquivo .env na raiz do projeto e copie o conteudo de .env-example para dentro do .env
   
5. Adicione ao .env a chave
    ```
   API_TOKEN_FOOTBALL=38c616efb09a42c195fdb27c9ea39e29



Observações:
Foi desenvolvido quase todos os requisitos, porém não pude dar continuidade no filtro por time pois a API usada não libera a função de pesquisa por team matches.


Ligas (campeonatos disponiveis):

 | WC | FIFA World Cup
 
 | CL | UEFA Champions League
 
 | BL1 | Bundesliga
 
 | DED | Eredivisie
 
 | BSA | Campeonato Brasileiro Série A

 | PD | Primera Division

 | FL1 | Ligue 1
 
 | ELC | Championship
 
 | PPL | Primeira Liga
 
 | EC | European Championship

 | SA | Serie A

 | PL | Premier League

 | CLI | Copa Libertadores


Detalhes: Em meus testes foi utilizado a competição "Premier League", você pode buscar tanto pela sigla quanto pelo nome.

![image](https://github.com/user-attachments/assets/e1e87f41-ceec-4b82-969e-cc07ef6c61ad)

 
