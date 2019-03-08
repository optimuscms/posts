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

None

**Example Response**

```json5
[
    {
        "id": 46,
        "title": "Cras sapien ligula",
        "image": {
             "id": 356,
             "folder_id": 12, 
             "name": "My Image", 
             "file_name": "my_image.jpg",
             "disk": "local",
             "mime_type": "image/jpeg", 
             "size": 102400,
             "created_at": "2017-12-24 09:36:23",
             "updated_at": "2017-12-25 10:15:12"
        },
        "slug": "cras-sapien",
        "body": "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>",
        "tags": [
            {
                "id": 22,
                "name": "Marketing",
                "slug": "marketing",
                "created_at": "2019-02-19 09:16:10",
                "updated_at": "2019-02-19 09:16:10"
            },
        ],
        "published_at": "2019-02-19 09:14:44",
        "created_at": "2019-02-19 09:14:44",
        "updated_at": "2019-02-19 09:14:50"
    },
    {
      // ...details of second post
    }
]
```


<a name="posts-get"></a>
### Get post
Get details of a specific post
```http
GET /admin/api/posts{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the post to fetch |


<a name="example-single-post-response"></a>
**Example Response**

```json5
{
    "id": 46,
    "title": "Cras sapien ligula",
    "image": {
         "id": 356,
         "folder_id": 12, 
         "name": "My Image", 
         "file_name": "my_image.jpg",
         "disk": "local",
         "mime_type": "image/jpeg", 
         "size": 102400,
         "created_at": "2017-12-24 09:36:23",
         "updated_at": "2017-12-25 10:15:12"
    },
    "slug": "cras-sapien",
    "body": "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>",
    "tags": [
        {
            "id": 22,
            "name": "Marketing",
            "slug": "marketing",
            "created_at": "2019-02-19 09:16:10",
            "updated_at": "2019-02-19 09:16:10"
        },
    ],
    "published_at": "2019-02-19 09:14:44",
    "created_at": "2019-02-19 09:14:44",
    "updated_at": "2019-02-19 09:14:50"
}
```

<a name="posts-create"></a>
### Create post
Create a new post
```http
POST /admin/api/posts
```

**Parameters**

@todo

**Example Response**

The newly created post is returned in the same format 
as [getting a single post](#example-single-post-response).

<a name="posts-update"></a>
### Update post
Update the details of a particular post
```http
PATCH /admin/api/posts/{id}
```

**Parameters**

@todo

**Example Response**

The updated post is returned in the same format 
as [getting a single post](#example-single-post-response).

<a name="posts-delete"></a>
### Delete post
Delete a particular post
```http
DELETE /admin/api/posts/{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the post to delete |

**Example Response**

The HTTP status code will be 204 if successful.

<a name="comments-all"></a>
### List comments
List all comments
```http
GET /admin/api/comments
```

**Parameters**

None

**Example Response**

@todo


<a name="comments-get"></a>
### Get comment
Get the details of a specific comment
```http
GET /admin/api/comments/{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the comment to fetch |

**Example Response**

@todo


<a name="comments-delete"></a>
### Delete comment
Delete a particular comment
```http
DELETE /admin/api/comments/{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the comment to delete |

**Example Response**

The HTTP status code will be 204 if successful.



<a name="tags-all"></a>
### List tags
List all available tags
```http
GET /admin/api/tags
```

**Parameters**

None

**Example Response**

```json5
[
    {
        "id": 21,
        "name": "Top Tips",
        "slug": "top-tips",
        "created_at": "2019-02-19 09:14:44",
        "updated_at": "2019-02-19 09:14:50"
    },
    {
        "id": 22,
        "name": "Marketing",
        "slug": "marketing",
        "created_at": "2019-02-19 09:16:10",
        "updated_at": "2019-02-19 09:16:10"
    },
]
```


<a name="tags-get"></a>
### Get tag
Get details of a specific tag
```http
GET /admin/api/tags{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the tag to fetch |


<a name="example-single-tag-response"></a>
**Example Response**

```json5
{
    "id": 21,
    "name": "Top Tips",
    "slug": "top-tips",
    "created_at": "2019-02-19 09:14:44",
    "updated_at": "2019-02-19 09:14:50"
}
```

<a name="tags-create"></a>
### Create tag
Create a new tag
```http
POST /admin/api/tags
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| name      |    ✓      | string| The user-facing name for the tag |

**Example Response**

The newly created tag is returned in the same format 
as [getting a single tag](#example-single-tag-response).

<a name="tags-update"></a>
### Update tag
Update the details of a particular tag
```http
PATCH /admin/api/tags/{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id        |    ✓      | int   | The ID of the tag to update |
| name      |    ✓      | string| A new user-facing name for the tag |

**Example Response**

The newly created tag is returned in the same format 
as [getting a single tag](#example-single-tag-response).

<a name="tags-delete"></a>
### Delete tag
Delete a particular tag
```http
DELETE /admin/api/tags/{id}
```

**Parameters**

| Parameter | Required? | Type  | Description    |
|-----------|-----------|-------|----------------|
| id      |    ✓      | int  | The ID of the tag to delete |

**Example Response**

The HTTP status code will be 204 if successful.
