pragma foreign_keys=OFF;

create table picture(
    fileName text unique,
    pictureType text
);

create table housePicture(
    houseID references house on delete cascade on update cascade,
    pictureID references house on delete cascade on update cascade
);

create table user(
    id integer primary key,
    username text unique,
    firstName text,
    lastName text,
    email text unique,
    profilePicture integer references picture(fileName) on delete set null on update cascade,
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
    decription text,
    area integer check(area > 0),
    address text,
    capacity integer check(capacity > 0)
);

create table rent(
    rentID integer primary key,
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
when (not exists (select rentID from rent where new.userID == rent.tenantID and new.houseID == rent.houseID))
begin
    select raise(ABORT, "User hasn't rented the house.");
end;


drop trigger if exists PreventRentOnHouse;
create trigger PreventRentOnHouse
before insert on rent
for each row
when(exists(select houseID from house where (new.tenantID == house.landlordID and new.houseID == house.houseID)))
begin
    select raise(ABORT, "Can't rent own house.");
end;


pragma foreign_keys=ON;