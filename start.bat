@echo off
ipconfig|find /i "IPv4">"%temp%\ip.txt"
set /p ip=<"%temp%\ip.txt"
set ip=%ip:. =%
set ip=%ip: =%
set ip=%ip::=%
set ip=%ip:IPv4ADDress=%
del /f /s /q "%temp%\ip.txt">nul2>nul
s:
@echo on
php -S 0.0.0.0:8000 -t public