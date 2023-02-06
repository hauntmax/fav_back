# zorra_test
<h2>Необходимо установить docker и docker-compose</h2>
- <h3>Проверка версий </h2>
```bash
  docker -v
  doсker-compose -v
```

- <h3>Данный проект был собран, используя следующие версии</h3>
- <code>Docker version 20.10.23, build 7155243</code>
- <code>docker-compose version 1.29.2, build 5becea4c</code>

<h2>После установки docker и docker-compose нужно выполнить команды из директории с проектом</h2>
```bash
cp .env.example .env
```
```bash
docker-compose build --build-arg USER_ID="$(id -u)" --build-arg USER="$(whoami)"
```
```bash
docker-compose up -d
```
```bash
sudo -- sh -c -e "echo 127.0.0.1 zorra.test >> /etc/hosts"
```
```bash
docker-compose exec app php artisan key:generate
```
```bash
docker-compose exec app composer install
```
```bash
docker-compose exec app php artisan migrate
```
```bash
docker-compose exec app php artisan jwt:secret
```

После выполнения команд проект будет доступен локально http://zorra.test/

<h2>Описание API</h2>
<details>
<summary>Авторизация и регистрация</summary>
    <details>
        <summary><code>POST /api/auth/register</code></summary>
        <pre><i>Request body</i>
{
    "name": "name",
    "email": "name@mail.ru",
    "password": "qqqwwweee123"
}</pre>
<pre><i>Response body</i>
{
    "data": {
        "name": "name",
        "email": "name@mail.ru",
        "created_at": "2023-02-06 02:30:05",
        "updated_at": "2023-02-06 02:30:05"
    }
}</pre>
<pre><i>Response statuses: 201</i></pre>
    </details>
    <details>
        <summary><code>POST /api/auth/login</code></summary>
        <pre><i>Request body</i>
{
    "email": "name@mail.ru",
    "password": "qqqwwweee123"
}</pre>
<pre><i>Response body</i>
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTYwOCwiZXhwIjoxNjc1NjU1MjA4LCJuYmYiOjE2NzU2NTE2MDgsImp0aSI6IlltbGNVNUhrZ0lTQ0NmMUkiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PPchOUUYSAb-HgFiZmH1Eskmx8KWqoGidqXWIUr_vj4",
    "token_type": "bearer",
    "expires_in": 3600,
    "status": 200
}</pre>
<pre><i>Response statuses: 200, 404, 422</i></pre>
    </details>
    <details>
        <summary><code>GET /api/auth/me</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
<pre><i>Response body</i>
{
    "data": {
        "name": "maks",
        "email": "maks@mail.ru",
        "created_at": "2023-02-05 10:38:48",
        "updated_at": "2023-02-05 10:38:48"
    }
}</pre>
<pre><i>Response statuses: 200, 401</i></pre>
    </details>
    <details>
        <summary><code>POST /api/auth/logout</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
<pre><i>Response body</i>
{
    "message": "User logout"
}</pre>
<pre><i>Response statuses: 200</i></pre>
    </details>
</details>

<details>
    <summary>Категории</summary>
    <details>
        <summary><code>GET /api/categories</code></summary>
        <pre><i>Request body</i>
{
    "page": 1,
    "per-page": 10,
}</pre>
<pre><i>Response body</i>
{
    "data": [
        {
            "category_id": 1,
            "user_id": 1,
            "name": "cat1",
            "description": "cat1",
            "created_at": "2023-02-05 13:43:31",
            "updated_at": "2023-02-05 13:43:31",
            "deleted_at": null
        },
        {
            "category_id": 2,
            "user_id": 1,
            "name": "cat2",
            "description": "cat2",
            "created_at": "2023-02-05 14:44:50",
            "updated_at": "2023-02-05 14:44:50",
            "deleted_at": null
        },
        {
            "category_id": 3,
            "user_id": 1,
            "name": "cat3",
            "description": "cat3",
            "created_at": "2023-02-05 14:44:57",
            "updated_at": "2023-02-05 14:44:57",
            "deleted_at": null
        }
    ],
    "links": {
        "first": "http://zorra.test/api/categories?page=1",
        "last": "http://zorra.test/api/categories?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://zorra.test/api/categories?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://zorra.test/api/categories",
        "per_page": 15,
        "to": 3,
        "total": 3
    }
}</pre>
<pre><i>Response statuses: 200</i></pre>
    </details>
    <details>
        <summary><code>POST /api/categories</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "name" : "catgegory666",
    "description" : "catgegory666"
}</pre>
<pre><i>Response body</i>
{
    "data": {
        "category_id": 4,
        "user_id": 1,
        "name": "catgegory666",
        "description": "catgegory666",
        "created_at": "2023-02-06 03:15:13",
        "updated_at": "2023-02-06 03:15:13",
        "deleted_at": null
    }
}
</pre>
<pre><i>Response statuses: 201, 422</i></pre>
    </details>
    <details>
        <summary><code>GET /api/categories/my</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "page": 1,
    "per-page": 10,
}</pre>
<pre><i>Response body</i>
{
    "data": [
        {
            "category_id": 1,
            "user_id": 1,
            "name": "cat1",
            "description": "cat1",
            "created_at": "2023-02-05 13:43:31",
            "updated_at": "2023-02-05 13:43:31",
            "deleted_at": null
        },
        {
            "category_id": 2,
            "user_id": 1,
            "name": "cat2",
            "description": "cat2",
            "created_at": "2023-02-05 14:44:50",
            "updated_at": "2023-02-05 14:44:50",
            "deleted_at": null
        },
        {
            "category_id": 3,
            "user_id": 1,
            "name": "cat3",
            "description": "cat3",
            "created_at": "2023-02-05 14:44:57",
            "updated_at": "2023-02-05 14:44:57",
            "deleted_at": null
        }
    ],
    "links": {
        "first": "http://zorra.test/api/categories?page=1",
        "last": "http://zorra.test/api/categories?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://zorra.test/api/categories?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://zorra.test/api/categories",
        "per_page": 15,
        "to": 3,
        "total": 3
    }
}</pre>
<pre><i>Response statuses: 200, 401</i></pre>
    </details>
    <details>
        <summary><code>GET /api/categories/{category}</code></summary>
        <pre><i>Response body</i>
{
    "data": {
        "category_id": 4,
        "user_id": 1,
        "name": "catgegory666",
        "description": "catgegory666",
        "created_at": "2023-02-06 03:15:13",
        "updated_at": "2023-02-06 03:15:13",
        "deleted_at": null
    }
}
</pre>
<pre><i>Response statuses: 200</i></pre>
    </details>
    <details>
        <summary><code>PUT /api/categories/{category}</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "name" : "zxccxz666",
    "description" : "cxzzxc666"
}</pre>
<pre><i>Response body</i>
{
    "data": {
        "category_id": 1,
        "user_id": 1,
        "name": "zxccxz666",
        "description": "cxzzxc666",
        "created_at": "2023-02-05 13:43:31",
        "updated_at": "2023-02-06 03:22:03",
        "deleted_at": null
    }
}
</pre>
<pre><i>Response statuses: 200, 422, 404</i></pre>
    </details>
    <details>
        <summary><code>DELETE /api/categories/{category}</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Response statuses: 204, 404</i></pre>
    </details>
    <details>
        <summary><code>GET /api/categories/{category}/products</code></summary>
<pre><i>Request body</i>
{
    "page": 1,
    "per-page": 10,
}</pre>
        <pre><i>Response body</i>
{
    "data": [
        {
            "product_id": 2,
            "user_id": 1,
            "name": "Product 2",
            "description": "Product 2",
            "price": 1499.99,
            "created_at": "2023-02-05 10:42:05",
            "updated_at": "2023-02-05 10:42:05",
            "deleted_at": null
        }
    ],
    "links": {
        "first": "http://zorra.test/api/categories/1/products?page=1",
        "last": "http://zorra.test/api/categories/1/products?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://zorra.test/api/categories/1/products?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://zorra.test/api/categories/1/products",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
</pre>
<pre><i>Response statuses: 200, 422</i></pre>
    </details>
</details>

<details>
    <summary>Товары</summary>
    <details>
        <summary><code>GET /api/products</code></summary>
        <pre><i>Request body</i>
{
    "page": 1,
    "per-page": 10,
}</pre>
<pre><i>Response body</i>
{
    "data": [
        {
            "product_id": 1,
            "user_id": 1,
            "name": "Product 1",
            "description": "Product 1",
            "price": 999.99,
            "created_at": "2023-02-05 10:39:27",
            "updated_at": "2023-02-05 10:39:27",
            "deleted_at": null
        },
        {
            "product_id": 2,
            "user_id": 1,
            "name": "Product 2",
            "description": "Product 2",
            "price": 1499.99,
            "created_at": "2023-02-05 10:42:05",
            "updated_at": "2023-02-05 10:42:05",
            "deleted_at": null
        }
    ],
    "links": {
        "first": "http://zorra.test/api/products?page=1",
        "last": "http://zorra.test/api/products?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://zorra.test/api/products?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://zorra.test/api/products",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}
</pre>
<pre><i>Response statuses: 200, 422</i></pre>
    </details>
    <details>
        <summary><code>POST /api/products</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
<pre><i>Request body</i>
{
    "name" : "prod1",
    "description" : "descrProd 1", // nullable
    "price" : 99.99, // nullable
    "category_ids" : [1,2] // nullable
}</pre>
<pre><i>Response body</i>
{
    "data": {
        "product_id": 4,
        "user_id": 1,
        "name": "prod1",
        "description": "descrProd 1",
        "price": 99.99,
        "created_at": "2023-02-06 03:55:26",
        "updated_at": "2023-02-06 03:55:26",
        "deleted_at": null
    }
}
</pre>
<pre><i>Response statuses: 201, 422</i></pre>
    </details>
    <details>
        <summary><code>GET /api/products/my</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "page": 1,
    "per-page": 10,
}
</pre>
        <pre><i>Response body</i>
{
    "data": [
        {
            "product_id": 1,
            "user_id": 1,
            "name": "Product 1",
            "description": "Product 1",
            "price": 999.99,
            "created_at": "2023-02-05 10:39:27",
            "updated_at": "2023-02-05 10:39:27",
            "deleted_at": null
        },
        {
            "product_id": 2,
            "user_id": 1,
            "name": "Product 2",
            "description": "Product 2",
            "price": 1499.99,
            "created_at": "2023-02-05 10:42:05",
            "updated_at": "2023-02-05 10:42:05",
            "deleted_at": null
        },
        {
            "product_id": 4,
            "user_id": 1,
            "name": "prod1",
            "description": "descrProd 1",
            "price": 99.99,
            "created_at": "2023-02-06 03:55:26",
            "updated_at": "2023-02-06 03:55:26",
            "deleted_at": null
        }
    ],
    "links": {
        "first": "http://zorra.test/api/products/my?page=1",
        "last": "http://zorra.test/api/products/my?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://zorra.test/api/products/my?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://zorra.test/api/products/my",
        "per_page": 15,
        "to": 3,
        "total": 3
    }
}</pre>
        <pre><i>Response statuses: 200, 422</i></pre>
    </details>
    <details>
        <summary><code>GET /api/products/{product}</code></summary>
        <pre><i>Response body</i>
{
    "data": {
        "product_id": 1,
        "user_id": 1,
        "name": "Product 1",
        "description": "Product 1",
        "price": 999.99,
        "created_at": "2023-02-05 10:39:27",
        "updated_at": "2023-02-05 10:39:27",
        "deleted_at": null
    }
}
</pre>
        <pre><i>Response statuses: 200, 404</i></pre>
    </details>
    <details>
        <summary><code>PUT /api/products/{product}</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "name" : "aaa",
    "description" : "descrProd aaa",
    "price" : 999.99,
    "category_ids" : [1,2]
}</pre>
        <pre><i>Response body</i>
{
    "data": {
        "product_id": 1,
        "user_id": 1,
        "name": "aaa",
        "description": "descrProd aaa",
        "price": 999.99,
        "created_at": "2023-02-05 10:39:27",
        "updated_at": "2023-02-06 04:15:16",
        "deleted_at": null
    }
}
</pre>
        <pre><i>Response statuses: 200, 422, 404</i></pre>
    </details>
    <details>
        <summary><code>DELETE /api/products/{product}</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Response statuses: 204, 404</i></pre>
    </details>
    <details>
        <summary><code>POST /api/products/{product}/attach</code></summary>
        <pre>Header: Authorization bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vem9ycmEudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY3NTY1MTk5NSwiZXhwIjoxNjc1NjU1NTk1LCJuYmYiOjE2NzU2NTE5OTUsImp0aSI6IkRITkp0UWphUTY4bUY3YW4iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Nfn8AaPi005iKtxT29unC7PhpWyI0aWp4Z0o4sQFhKc</pre>
        <pre><i>Request body</i>
{
    "category_ids" : [1,2]
}
</pre>
        <pre><i>Response body</i>
{
    "data": {
        "attached": [],
        "detached": [],
        "updated": []
    }
}
</pre>
        <pre><i>Response statuses: 200, 422, 404</i></pre>
    </details>
</details>

[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
[//]: # (- <code></code>)
