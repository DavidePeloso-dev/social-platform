### Seleziona gli utenti che hanno postato almeno un video (25)
```
    SELECT DISTINCT `users`.`username`, `medias`.`type` AS `media_type` 
    FROM `users`
    JOIN `medias`
    ON `medias`.`user_id` = `users`.`id` 
    WHERE `medias`.`type` = "video";
```
### Seleziona tutti i post senza Like (13)
```
    SELECT DISTINCT `posts`.`title`
    FROM `posts`
    LEFT JOIN `likes`
    ON `likes`.`post_id` = `posts`.`id` 
    WHERE `likes`.`post_id` IS NULL;
```
### Conta il numero di like per ogni post (165)
```
    SELECT `posts`.`id` AS `post_id`,`posts`.`title` AS `post_title`, COUNT(`likes`.`post_id`) AS `post_likes`
    FROM `posts`
    LEFT JOIN `likes`
    ON `likes`.`post_id` = `posts`.`id`
    GROUP BY `posts`.`id`  
	ORDER BY `post_likes`  ASC
```
### Ordina gli utenti per il numero di media caricati (25)
```
	SELECT `users`.`id` AS `user_id`,`users`.`username`, COUNT(`medias`.`id`) AS `media_uploaded`
    FROM `medias`
    LEFT JOIN `users`
    ON `medias`.`user_id` = `users`.`id`
    GROUP BY `medias`.`user_id`  
	ORDER BY `media_uploaded`  ASC;
```
### Ordina gli utenti per totale di likes ricevuti nei loro posts (25)
```
	SELECT `users`.`id` AS `user_id`,`users`.`username`, COUNT(`likes`.`post_id`) AS `like_received`
    FROM `likes`
    LEFT JOIN `users`
    ON `likes`.`user_id` = `users`.`id`
    GROUP BY `likes`.`user_id`  
    ORDER BY `like_received`  ASC;
```