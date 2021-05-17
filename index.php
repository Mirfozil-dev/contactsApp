<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="shortcut icon" href="assets/icons8-contacts.svg" type="image/svg">
  <title>My contacts</title>
</head>
<body>
<div class="content">
  <div class="alert"></div>
  <div class="add_block">
    <p>Добавить контакт</p>
    <input id="name" type="text" placeholder="Имя">
    <input id="number" type="tel" placeholder="Телефон">
    <button onclick="addContact()" type="submit">Добавить</button>
  </div>
  <div class="contacts_block">
    <div class="contacts_block__title">
      <p>Список Контактов</p>
    </div>
    <div class="contacts_block__body"></div>
  </div>
</div>
<script type="text/javascript">
    function showAlert(text, color) {
        let alert = document.querySelector('.alert')
        alert.classList.add('active')
        alert.classList.add(color)
        alert.innerHTML = text
        setTimeout(() => {
            alert.classList.remove('active')
            alert.classList.remove(color)
        }, 2000)
    }
    function getContacts() {
        try {
            fetch('getContacts.php').then(r => {
                return r.json()
            }).then(d => {
                let contactsBlock = document.querySelector('.contacts_block__body');
                let html = ``;
                d.map(item => {
                    html += `
            <div class="contacts_block__item">
              <div class="contacts_block__item_header">
                <p>${item.name}</p>
                <button onclick="deleteContact(${item.id})">&times;</button>
              </div>
              <p>${item.number}</p>
            </div>
            `
                })
                contactsBlock.innerHTML = html
            })
        } catch (e) {
            console.log(e)
        }
    }

    function deleteContact(id) {
        try {
            fetch('deleteContact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            }).then(r => r.json()).then(d => {
                console.log(d)
                getContacts()
            })
            showAlert('Контакт удален!', 'red')
        } catch (e) {
            console.log(e)
        }
    }

    function addContact() {
        let name = document.querySelector('#name');
        let number = document.querySelector('#number');
        if (name.value !== '' && number.value !== '') {
            try {
                fetch('addContact.php', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name.value,
                        number: number.value
                    })
                }).then(r => r.json()).then(d => {
                    console.log(d)
                    name.value = ''
                    number.value = ''
                    getContacts()
                })
                showAlert('Контакт добавлен!', 'green')
            } catch (e) {
                console.log(e)
            }
        }

    }
    window.onload = () => {
        getContacts()
    }
</script>
</body>
</html>