Чтобы развернуть проект:
1. composer install
2. php -S localhost:8000    

Далее все запросы POST по адресу localhost:8000

Получение списка локаций по массиву идентификаторов
```json 
{
  "jsonrpc": "2.0",
  "id": 2,
  "method": "location.getList", 
  "params": {
    "ids": [1, 5]
  }
}
```

Получение  кол-ва персонажей в локации по её идентификатору
```json 
{
  "jsonrpc": "2.0",
  "id": 2,
  "method": "location.charactersCount", 
  "params": {
    "id": 1
  }
}
```

Получение списка персонажей по номеру эпизода
```json 
{
  "jsonrpc": "2.0",
  "id": 2,
  "method": "character.getListByEpisodeId", 
  "params": {
    "id": 1
  }
}
```