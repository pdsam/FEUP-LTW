pragma foreign_keys=OFF;

create table housePicture(
    pictureID text primary key,
    houseID references house on delete cascade on update cascade
);

create table user(
    id integer primary key,
    username text unique,
    firstName text,
    lastName text,
    email text unique,
    profilePicture text default 'default',
    password text not null
);

create table tenant(
    id integer primary key references user on delete cascade on update cascade
);

create table landlord(
    id integer primary key references user on delete cascade on update cascade
);

create table house(
    houseID integer primary key,
    landlordID integer references landlord on delete cascade on update cascade,
    pricePerNight integer check(priceperNight > 0), 
    avgRating real check(avgRating >= 0) default 0,
    title text,
    description text,
    area integer check(area > 0),
    address text,
    capacity integer check(capacity > 0)
);

create table reservation(
    reservationID integer primary key,
    tenantID integer references tenant on delete cascade on update cascade,
    houseID integer references house on delete cascade on update cascade,
    startDate text,
    endDate text,
    numberOfPeople integer check(numberOfPeople > 0)
);

create table review(
    reviewID integer primary key,
    houseID integer references house on delete cascade on update cascade,
    userID integer references tenant on delete cascade on update cascade,
    rating integer check(rating >= 0 and rating <= 10),
    reviewText text,
    postedDate integer not null default CURRENT_TIMESTAMP
);


drop trigger if exists AddedUser;
create trigger AddedUser
after insert on user
for each row
begin
insert into tenant(id) values(new.id);
end;


drop trigger if exists CreateReview;
create trigger CreateReview
before insert on review
for each row
when (not exists (select reservationID from reservation where new.userID == reservation.tenantID and new.houseID == reservation.houseID))
begin
    select raise(ABORT, "User hasn't rented the house.");
end;


drop trigger if exists PreventRentOwnHouse;
create trigger PreventRentOwnHouse
before insert on reservation
for each row
when(exists(select houseID from house where (new.tenantID == house.landlordID and new.houseID == house.houseID)))
begin
    select raise(ABORT, "Can't rent own house.");
end;


pragma foreign_keys=ON;