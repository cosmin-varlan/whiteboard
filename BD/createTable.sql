create table users(id integer primary key autoincrement, name text not null, nick text, email text not null , password text not null, created_at date, updated_at date, constraint unique_email unique(email));
create table whiteboards(id integer primary key autoincrement, topic text not null, ownerID integer, created_at date, updated_at date, foreign key (ownerID) references users(id));
create table access(id integer primary key autoincrement, userID integer, whiteboardID integer, created_at date, updated_at date, foreign key (userID) references users(id), foreign key (whiteboardID) references whiteboards(id));
create table messages(id integer primary key autoincrement, userID integer, whiteboardID integer, message text not null, created_at date, updated_at date, foreign key (userID) references users(id), foreign key (whiteboardID) references whiteboards(id));

