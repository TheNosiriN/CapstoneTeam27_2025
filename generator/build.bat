@echo off
setlocal

set GSON_JAR=..\lib\gson-2.12.1.jar
javac -d build -cp .;..\lib\mysql-connector-j-9.2.0.jar *.java
java -cp build;..\lib\mysql-connector-j-9.2.0.jar Main

endlocal
