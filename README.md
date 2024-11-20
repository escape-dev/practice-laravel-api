# Project kali ini adalah latihan saya dalam membuat RESTful API
pembuatan RESTful API ini menggunakan bahasa pemrogramman php dan menggunakan framework laravel dengan database mysql

## Endpoints
note: jangan lupa menambahkan ```Accept => application/json``` di header
### Contacts
* Get all contacts  : ``` GET /api/contacts ```
* Post a contacts   : ``` POST /api/contacts ```
* Update a contacts : ``` PUT /api/contacts/{id} ```
* Delete a contacts : ``` DELETE /api/contacts/{id} ```

### Authentication
* sign in : ``` POST /api/signin ```
* sign up : ``` POST /api/register ```


### Somewhat usefull method

- unique validation for create or update 
``` 'phone' => ['required', 'numeric', 'digits_between:10,15', Rule::unique('contacts')->ignore($this->contact)] ```