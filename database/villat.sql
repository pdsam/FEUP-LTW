PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE housePicture(
    pictureID text primary key,
    houseID references house on delete cascade on update cascade
);
CREATE TABLE user(
    id integer primary key,
    username text unique,
    firstName text,
    lastName text,
    email text unique,
    profilePicture text default 'default',
    password text not null,
    bio text default 'Bio Out of service'
);
INSERT INTO user VALUES(1,'jradaval','Jarvazio','Radaval','jradaval@gmail.com','default','$2y$10$zEqUtTFDw5YLwArg.imnoOwHIDYWxbp3cBJFx0k3Yzx4ULD8wWiQe', 'a');
INSERT INTO user VALUES(2,'manel','Manel','Manuel','manel@manel.manel','default','$2y$10$oL01mgnRlqmXaE2mpMfkNeFDu.otdBtG4fMy8oJu6Z8zrfEXnFala', 'b');
INSERT INTO user VALUES(3,'motavia','Maria','Otavia','motavia@gmail.com','default','$2y$10$T6PDAC.jFX0rsbJAg.TSy.sTL1QCcukGYjOAc/gIPEd.9/NTumrRa', 'c');
CREATE TABLE tenant(
    id integer primary key references user on delete cascade on update cascade
);
INSERT INTO tenant VALUES(1);
INSERT INTO tenant VALUES(2);
INSERT INTO tenant VALUES(3);
CREATE TABLE landlord(
    id integer primary key references user on delete cascade on update cascade
);
INSERT INTO landlord VALUES(1);
INSERT INTO landlord VALUES(2);

CREATE TABLE location(
    locationID integer primary key,
    name text
);
INSERT INTO location values (1, "Aveiro"),(2, "Beja"),(3, "Braga"),(4, "Bragança"),
(5, "Castelo Branco"),(6, "Coimbra"),(7, "Évora"),(8, "Faro"),(9, "Guarda"),
(10, "Leiria"),(11, "Lisboa"),(12, "Portalegre"),(13, "Porto"),(14, "Santarém"),
(15, "Setúbal"),(16, "Viana do Castelo"),(17, "Vila Real"),(18, "Viseu");

CREATE TABLE house(
    houseID integer primary key,
    landlordID integer references landlord on delete cascade on update cascade,
    pricePerNight integer check(priceperNight > 0), 
    avgRating real check(avgRating >= 0) default 0,
    title text,
    description text,
    area integer check(area > 0),
    locationID integer references location on delete set null on update cascade,
    capacity integer check(capacity > 0)
);
INSERT INTO house VALUES(1,1,12,0.0,'Very nice description','A very nice house much wow',100,6,5);
INSERT INTO house VALUES(2,2,10,0.0,'Casota','House arround the sea with beautiful landscapes',140,7,3);
INSERT INTO house VALUES(3,2,9,0.0,'Casinha','Im kinda running out of descriptions',50,1,1);
INSERT INTO house VALUES(4,2,20,0.0,'Casarao','Damn, I need another description',400,16,6);
INSERT INTO house VALUES(5,2,15,0.0,'Haha','I dont like php very much :(',200,18,3);
INSERT INTO house VALUES(6,1,5,0.0,'Casa','Casa muito bonita.',200,13,2);
CREATE TABLE reservation(
    reservationID integer primary key,
    tenantID integer references tenant on delete cascade on update cascade,
    houseID integer references house on delete cascade on update cascade,
    startDate text,
    endDate text,
    numberOfPeople integer check(numberOfPeople > 0), 
    status text check(status='pending' or status='accepted' or status='rejected' or status='canceled') default 'pending'
);
INSERT INTO reservation VALUES(1,3,6,'2019-12-09','2019-12-11',2,'accepted');
INSERT INTO reservation VALUES(2,3,6,'2019-12-12','2019-12-21',2,'accepted');
INSERT INTO reservation VALUES(3,3,6,'2019-12-23','2019-12-27',2,'pending');
CREATE TABLE review(
    reviewID integer primary key,
    houseID integer references house on delete cascade on update cascade,
    userID integer references tenant on delete cascade on update cascade,
    rating integer check(rating >= 0 and rating <= 10),
    reviewText text,
    postedDate integer not null default CURRENT_TIMESTAMP
);
INSERT INTO review(houseID,userID,rating,reviewText) VALUES (1,1,4,'muito lindo');
INSERT INTO review(houseID,userID,rating,reviewText) VALUES (1,3,7,'muito feio');
CREATE TRIGGER AddedUser
after insert on user
for each row
begin
insert into tenant(id) values(new.id);
end;
CREATE TRIGGER CreateReview
before insert on review
for each row
when (not exists (select reservationID from reservation where new.userID == reservation.tenantID and new.houseID == reservation.houseID))
begin
    select raise(ABORT, "User hasn't rented the house.");
end;
CREATE TRIGGER PreventRentOwnHouse
before insert on reservation
for each row
when(exists(select houseID from house where (new.tenantID == house.landlordID and new.houseID == house.houseID)))
begin
    select raise(ABORT, "Can't rent own house.");
end;
CREATE TRIGGER UpdateHouseAvgScore
after insert on review
for each row
begin
    update house set avgRating=(
        select avg(rating) from review where houseID=new.houseID
    ) where houseID=new.houseID;
end;
COMMIT;
PRAGMA foreign_keys=ON;