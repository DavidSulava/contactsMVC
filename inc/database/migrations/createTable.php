<?php
namespace inc\database\migrations;

class CreateDataBase{
    public $allCommands = [];

    public function up(){

        $this->allCommands[]='CREATE TABLE IF NOT EXISTS
                                "User" (
                                "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
                                "email" text(60) NOT NULL,
                                "password" text(255) NOT NULL,
                                "email_verified_at" DATETIME DEFAULT NULL,
                                "remember_token"  text(255) DEFAULT NULL,
                                "created_at" DATETIME DEFAULT CURRENT_TIMESTAMP )';

        $this->allCommands[]= ' CREATE UNIQUE INDEX IF NOT EXISTS "idx_contacts_email" ON "User" ("email") ';


        $this->allCommands[]= 'CREATE TABLE IF NOT EXISTS
                                "Contacts" (
                                    "id" integer NOT NULL,
                                    "c_id" integer NOT NULL,
                                    "created_at" DATETIME DEFAULT CURRENT_TIMESTAMP,
                                    FOREIGN KEY ("id") REFERENCES "User" ("id") ON DELETE CASCADE
                                    FOREIGN KEY ("c_id") REFERENCES "User" ("id") ON DELETE CASCADE
                                )';

        return $this->allCommands;
    }
    public function down(){
        $this->allCommands[]= "DROP TABLE Contacts";
        $this->allCommands[]= "DROP TABLE User";
    }
}