import { Client, Account } from "appwrite";

const client = new Client()
    .setEndpoint('https://cloud.appwrite.io/v1')
    .setProject('66e10e05001f795c0b6c');

const account = new Account(client)

export {account, client};