import { account } from './appwrite'

const loginBtn = document.getElementById('login-btn')
const logoutBtn = document.getElementById('logout-btn')
const profileScreen = document.getElementById('profile-screen')
const loginScreen = document.getElementById('login-screen')

async function handleLogin (){
    account.create0Auth2Session(
        'google',
        'http://localhost:80/',
        'http://localhost:80/fail'
    )
}
async function getUser (){
    try{
        const user = await account.get()
        renderProfileScreen(user)
    }catch(error){
        renderLoginScreen()
    }
}

function renderLoginScreen (){
    loginScreen.classList.remove('hidden')
}

async function renderProfileScreen (user) {
    document.getElemementById('user-name').textContent = user.name
    profileScreen.classList.remove('hidden')
}

async function handleLogout(){
    account.deleteSession('current')
    profileScreen.classList.add('hidden')
    renderLoginScreen()
}