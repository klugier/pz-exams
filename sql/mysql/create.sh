#!/bin/bash 
# Sposób użycia: ./create.sh -u root -d new_database

isQuite=0
databaseName=""
databaseUser=""

args=("$@")
i=0
for arg in "$@" ; do
	if [ "$arg" == "-u" ] || [ "$arg" == "--user" ] ; then
		databaseUser=${args[$i + 1]}
	elif [ "$arg" == "-d" ] || [ "$arg" == "--database" ] ; then
		databaseName=${args[$i + 1]}
	elif [ "$arg" == "-q" ] || [ "$arg" == "--quite" ] ; then
		isQuite=1
	elif [ "$arg" == "--help" ] || [ "$arg" == "--help" ] ; then
		printf "Przykładowy sposób użycia: ./create.sh -u root -d new_database\n\n"
		printf "Opcje:\n"
		printf "    -u lub --user     - ustawia nazwę użytkownika\n"
		printf "    -d lub --database - ustawia nazwę bazydanych\n"
		printf "    -h lub --help     - wyświetla informację z pomocą\n"
		exit 0
	fi
	
	i=$((i+1))
done

# We need to check if mysql is installed on target machine 
mysql=${mysql="mysql"}
if ! which "$mysql" >/dev/null; then
	if [ $isQuite == 0 ] ; then
		printf "Błąd krytyczny: Nie udało odnaleźć się następującego programu: \"mysql\".\n"
	fi
	
	exit 1
fi

if [ "$databaseUser" == "" ] ; then
	printf "Nie podano nazwy użytkownika.\n"
	exit -1
fi

/usr/bin/mysql -u $databaseUser -p -e "
	SET @databaseName:='$databaseName';
	SOURCE create/database.sql;
	USE $databaseName;
	SOURCE create/tables.sql;
"
