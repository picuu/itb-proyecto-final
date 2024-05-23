# Response Examples for API Endpoints

## Error response

```json
{
  "status": "error"
}
```

## User response

```json
{
  "status": "success",
  "id": 1,
  "name": "David",
  "surname": "Marin",
  "email": "david.marin@itb.cat",
  "phone": "123456789",
  "password": "md5hashpassword",
  "balance": 1120,
  "auth_level": {
    "level": 1,
    "name": "admin"
  }
}
```

## Valoration response

```json
{
  "status": "success",
  "id": 1,
  "owner_id": 1,
  "valorated_member_id": 2,
  "punctuation": 5,
  "comment": "Great service",
  "publish_date": {
    "day": 19,
    "month": 5,
    "year": 2024,
    "hour": 18,
    "minute": 25
  }
}
```

## Booking response

```json
{
  "status": "success",
  "id": 1,
  "publisher_id": 2,
  "enrolled_id": 1,
  "advert_id": 1,
  "date": {
    "day": 19,
    "month": 5,
    "year": 2024,
    "hour": 18,
    "minute": 25
  }
}
```

## History response

```json
{
  "status": "success",
  "id": 1,
  "publisher_id": 2,
  "enrolled_id": 1,
  "advert": {
    "id": 1,
    "owner_id": 2,
    "title": "Clases de violín",
    "description": "Ofrezco clases de violín en mi casa",
    "price": 10,
    "category_id": 1,
    "time": {
      "hours": 1,
      "minutes": 30
    },
    "ubication": {
      "latitude": 41.3851,
      "longitude": 2.1734
    },
    "availability": [
      {
        "day": 1,
        "month": 5,
        "year": 2024,
        "hour": 10,
        "minute": 0
      },
      {
        "day": 3,
        "month": 5,
        "year": 2024,
        "hour": 10,
        "minute": 30
      },
      {
        "day": 5,
        "month": 5,
        "year": 2024,
        "hour": 10,
        "minute": 30
      }
    ],
    "publish_date": {
      "day": 19,
      "month": 5,
      "year": 2024,
      "hour": 18,
      "minute": 25
    }
  },
  "booking": {
    "id": 1,
    "publisher_id": 2,
    "enrolled_id": 1,
    "advert_id": 1,
    "date": {
      "day": 19,
      "month": 5,
      "year": 2024,
      "hour": 18,
      "minute": 25
    }
  }
}
```

## Advert response

```json
{
  "status": "success",
  "id": 1,
  "owner_id": 2,
  "title": "Clases de violín",
  "description": "Ofrezco clases de violín en mi casa",
  "price": 10,
  "category_id": 1,
  "time": {
    "hours": 1,
    "minutes": 30
  },
  "ubication": {
    "latitude": 41.3851,
    "longitude": 2.1734
  },
  "availability": [
    {
      "day": 1,
      "month": 5,
      "year": 2024,
      "hour": 10,
      "minute": 0
    },
    {
      "day": 3,
      "month": 5,
      "year": 2024,
      "hour": 10,
      "minute": 30
    },
    {
      "day": 5,
      "month": 5,
      "year": 2024,
      "hour": 10,
      "minute": 30
    }
  ],
  "publish_date": {
    "day": 19,
    "month": 5,
    "year": 2024,
    "hour": 18,
    "minute": 25
  }
}
```

## Categories response

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Musica"
    },
    {
      "id": 2,
      "name": "Deporte"
    },
    {
      "id": 3,
      "name": "Educación"
    }
  ]
}
```
