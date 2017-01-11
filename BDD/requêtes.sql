--
-- database connection
--
connect moodmapDB

--
-- user
--
INSERT INTO user (username,email,password,activated,challenge)
 VALUES("elhafiani","elhafiani@ensicaen.fr","A59DFE0E288E1208A0FFF3C", false, "AB123EF");

--
-- impression
--
INSERT INTO impression (name,iconpath)
VALUES("happy","/icons/happy.png");



INSERT INTO impression (name,iconpath)
 VALUES("sad","/icons/sad.png");

--
-- zone
--
INSERT INTO zone (name,p1_x, p1_y, p2_x, p2_y)
VALUES("zone1", 20, 20, 30, 30);


INSERT INTO zone (name,p1_x, p1_y, p2_x, p2_y)
VALUES("zone2", 40, 40, 45, 45);

--
-- dataZone
--
INSERT INTO datazone (score,id_zone,id_impression)
 VALUES(33.64, 1, 2); 

INSERT INTO datazone (score,id_zone,id_impression)
 VALUES(62.4, 2, 1);

--
-- vote
--
INSERT INTO vote (id_user,id_impression,id_datazone)
VALUES(1, 1, 1);

INSERT INTO vote (id_user,id_impression,id_datazone)
VALUES(1, 2, 2);

--
-- SELECT REQUESTS
--
SELECT * from user;
SELECT * from impression;
select * from vote;
select * from datazone;
select * from zone;

