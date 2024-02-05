
--
-- Trigger `follow`
--
DELIMITER $$
CREATE TRIGGER `FollowNotification` AFTER INSERT ON `follow` FOR EACH ROW BEGIN
    declare new_notification_id int;
    SET @new_notification_id := (SELECT MAX(id) FROM notification);
    INSERT INTO notification VALUES ((@new_notification_id+1),CONCAT("L'utente ",(SELECT username FROM user WHERE id=NEW.following_user_id)," ha iniziato a seguirti"),CONCAT('profile/',(SELECT username FROM user WHERE id=NEW.following_user_id)));
    INSERT INTO has_notification (user_id, notification_id) VALUES (NEW.followed_user_id, (@new_notification_id +1));

END
$$
DELIMITER ;


--
-- Trigger `like_actions`
--
DELIMITER $$
CREATE TRIGGER `LikeNotification` AFTER INSERT ON `like_actions` FOR EACH ROW BEGIN
	DECLARE new_notification_id INT;
    SET @new_notification_id := (SELECT MAX(id) FROM notification);
    INSERT INTO notification (id,content,url) VALUES((@new_notification_id+1), CONCAT('L utente',(SELECT username FROM user WHERE id=NEW.user_id),'ti ha messo like alla recensione del ristorante:  ',(SELECT name FROM restaurant WHERE id=(SELECT restaurant_id FROM review WHERE id=NEW.review_id))), CONCAT('profile/',(SELECT username FROM user WHERE id=NEW.user_id)));
    INSERT INTO has_notification (user_id, notification_id) VALUES ((SELECT publisher_id FROM review WHERE id=NEW.review_id), (@new_notification_id+1));
END
$$
DELIMITER ;