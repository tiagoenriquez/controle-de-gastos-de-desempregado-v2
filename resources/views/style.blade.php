<style>
:root {
    --porco: rgb(202, 88, 113);
    --porco-claro: rgb(229, 172, 184);
    --porco-muito-claro: rgb(242, 214, 220);
    --porco-pouco-claro: rgb(216, 130, 149);
    --porco-escuro: rgb(101, 44, 57);
    --porco-muito-escuro: rgb(51, 22, 29);
    --porco-pouco-escuro: rgb(152, 66, 85);
    --moeda: rgb(247, 205, 100);
    --moeda-clara: rgb(251, 230, 178);
    --moeda-muito-clara: rgb(253, 243, 217);
    --moeda-pouco-clara: rgb(249, 218, 139);
    --moeda-escura: rgb(124, 103, 50);
    --moeda-muito-escura: rgb(62, 52, 25);
    --moeda-pouco-escura: rgb(186, 154, 75);
    --erro: rgb(253, 22, 29);
    --familia-da-fonte: serif;
    --margem: 12px;
    --padding-para-texto: 8px 16px;
    --tamanho-da-fonte: 16px;

}

body {
    background-color: var(--porco);
    color: var(--moeda); 
    min-height: 100vh;
    min-width: 100vw;
    margin: 0px;
}

button {
    background-color: var(--porco-escuro);
    border: none;
    color: var(--moeda);
    cursor: pointer;   
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    margin: var(--margem);
    padding: var(--padding-para-texto);
}

button:hover {
    background-color: var(--porco-pouco-escuro);
}

button:active {
    background-color: var(--porco-escuro);
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

h1 {
    font-family: var(--familia-da-fonte);
    font-size: calc(var(--tamanho-da-fonte) * 2);
    margin: var(--margem);
}

img {
    background-color: var(--porco-escuro);
    height: 24px;
    width: auto;
}

input {
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    margin: var(--margem);
    padding: var(--padding-para-texto);
    width: 224px;
}

input[type='file'] {
    display: none;
}

label {
    color: var(--moeda-clara);
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    margin: var(--margem);
    padding: var(--padding-para-texto);
    text-align: right;
    width: 256px;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 64px);
    min-width: 100vw;
}

nav {
    background-color: var(--porco-escuro);
    height: 64px;
    display: flex;
    flex-direction: row;
    align-items: center;
}

select {
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    margin: var(--margem);
    padding: var(--padding-para-texto);
    width: 256px;
}

table {
    margin: var(--margem);
}

tbody tr:hover {
    background-color: var(--porco-pouco-claro);
}

td {
    color: var(--moeda-clara);
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    padding: 0px 16px;
    text-align: center;
}

th {
    font-family: var(--familia-da-fonte);
    font-size: var(--tamanho-da-fonte);
    font-weight: bold;
    padding: var(--padding-para-texto);
    text-align: center;
    text-transform: uppercase;
}

thead {
    background-color: var(--cor-escura);
    color: var(--moeda-clara);
}

.erro {
    background-color: var(--erro);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.iconed-button {
    padding: 8px;
}

.file_label {
    cursor: pointer;
    width: 256px;
}

.menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu li {
    position: relative;
    float: left;
}

.menu li a {
    padding: var(--padding-para-texto);
    display: block;
    text-decoration: none;
    background-color: var(--porco-escuro);
    color: var(--moeda);
}

.menu li ul {
    list-style: none;
    position: absolute;
    top: 100%; /* Mover o submenu para baixo do item principal */
    left: 0;
    background-color: var(--porco-escuro);
    display: none;
    padding: 0;
    margin: 0;
}

.menu li:hover > ul {
    display: block; /* Mostrar o submenu quando o item principal for hover */
}

.menu li ul li {
    width: 256px;
    white-space: nowrap;
}

.menu li ul li a {
    padding: var(--padding-para-texto);
    background-color: var(--porco-escuro);
    color: var(--moeda);
    display: block;
}

.menu li ul li a:hover {
    background-color: var(--porco-pouco-escuro);
}

.row-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

#data {
    width: 224px;
}
</style>