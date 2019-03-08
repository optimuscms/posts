# Optimus Posts

This package provides the core backend functionality for managing blog posts, comments, and tags within the CMS.

## Installation

This package can be installed through Composer.

```bash
composer require optimuscms/posts
```

In Laravel 5.5 and above the package will autoregister the service provider. 

In Laravel 5.4 you must install this service provider:
```php
// config/app.php
'providers' => [
    ...
    Optimus\Posts\Providers\PostServiceProvider,
    ...
];
```


## API Routes

The API follows standard RESTful conventions, with responses being returned in JSON. 
Appropriate HTTP status codes are provided, and these should be used to check the outcome of an operation.

**Posts**
 - [List posts](#posts-all)
 - [Get post](#posts-get)
 - [Create post](#posts-create)
 - [Update post](#posts-update)
 - [Delete post](#posts-delete)
 
**Comments**
 - [List comments](#comments-all)
 - [Get comment](#comments-get)
 - [Delete comment](#comments-delete)
 
**Tags**
  - [List tags](#tags-all)
  - [Get tag](#tags-get)
  - [Create tag](#tags-create)
  - [Update tag](#tags-update)
  - [Delete tag](#tags-delete)
  

<a name="posts-all"></a>
### List posts
List all available posts
```http
GET /admin/api/posts
```

**Parameters**

@todo

**Example Response**

@todo


<a name="posts-get"></a>
### Get post
Get details of a specific post
```http
GET /admin/api/posts{id}
```

**Parameters**

@todo

**Example Response**

@todo

<a name="posts-create"></a>
### Create post
Create a new post
```http
POST /admin/api/posts
```

**Parameters**

@todo

**Example Response**

@todo

<a name="posts-update"></a>
### Update post
Update the details of a particular post
```http
PATCH /admin/api/posts/{id}
```

**Parameters**

@todo

**Example Response**

@todo

<a name="posts-delete"></a>
### Delete post
Delete a particular post
```http
DELETE /admin/api/posts/{id}
```

**Parameters**

@todo

**Example Response**

@todo

<a name="comments-all"></a>
### List comments
List all comments
```http
GET /admin/api/comments
```

**Parameters**

@todo

**Example Response**

@todo


<a name="comments-get"></a>
### Get comment
Get the details of a specific comment
```http
GET /admin/api/comments/{id}
```

**Parameters**

@todo

**Example Response**

@todo


<a name="comments-delete"></a>
### Delete comment
Delete a particular comment
```http
DELETE /admin/api/comments/{id}
```

**Parameters**

@todo

**Example Response**

@todo



<a name="tags-all"></a>
### List tags
List all available tags
```http
GET /admin/api/tags
```

**Parameters**

@todo

**Example Response**

@todo


<a name="tags-get"></a>
### Get tag
Get details of a specific tag
```http
GET /admin/api/tags{id}
```

**Parameters**

@todo

**Example Response**

@todo

<a name="tags-create"></a>
### Create tag
Create a new tag
```http
POST /admin/api/tags
```

**Parameters**

@todo

**Example Response**

@todo

<a name="tags-update"></a>
### Update tag
Update the details of a particular tag
```http
PATCH /admin/api/tags/{id}
```

**Parameters**

@todo

**Example Response**

@todo

<a name="tags-delete"></a>
### Delete tag
Delete a particular tag
```http
DELETE /admin/api/tags/{id}
```

**Parameters**

@todo

**Example Response**

@todo
