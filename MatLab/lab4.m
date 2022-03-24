%Nuskaitomi duomenys is failo
frd = fopen('lab4.dat','r');
X = fscanf(frd, '%d');
fclose(frd);
X = X';

[Xs,suma,Xvid,X,C,maz,indexmin] = lab4f (X);
%Duomenys isvedami i ekrana min(C),find(C==min(C)))
disp("Masyvas X:"),disp(X);
disp("Masyvas C:"),disp(C);
disp("Masyvo C maziausias elementas:"),disp(maz);
disp("Masyvo C maziausio elemento indeksas:"),disp(indexmin);
disp("Rezultatai surasyti i lab4.dat faila");
disp("Dovydas Kasiliauskis 4 laboratorinis darbas 10 variantas");
%Duomenys isvedami i faila
frw = fopen('lab4.rez','w');
fprintf(frw, 'Masyvas X: \n');
fprintf(frw,'%6.2f',X);
fprintf(frw, '\n Masyvas C: \n');
fprintf(frw,'%6.2f',C);

fprintf(frw, '\n Masyvo C maziausias elementas: \n');
fprintf(frw,'%6.2f',maz);

fprintf(frw, '\n Masyvo C maziausio elemento indeksas: \n');
fprintf(frw,'%6.2f',indexmin);
fclose(frw);
