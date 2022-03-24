%Darbo autorius - Dovydas Kasiliauskis PS-0/2 10 variantas
X = dlmread('lab5.dat', ' ', 1, 0);

[X,b,geriausias_egzaminas,desimtukai_geriausio_egzamino,geriaus_egzas,neislaike_egzo] = lab5f (X);

disp("Masyvas X:"),disp(X);
disp("Geriausio egzamino numeris:"),disp(geriausias_egzaminas);
disp("Studentu gavusiu 10 siame egzamine numeriai:"),disp(desimtukai_geriausio_egzamino);
disp("Studentu neislaikiusiu sio egzamino numeriai:"),disp(neislaike_egzo);
%Duomenu isvedimas i lab5.rez faila
frw = fopen('lab5.rez','w');
fprintf(frw, 'Geriausio egzamino numeris: \n');
fprintf(frw,'%6.2f', geriausias_egzaminas);
fprintf(frw, '\n Studentu gavusiu 10 siame egzamine numeriai: \n');
fprintf(frw,'%6.2f', desimtukai_geriausio_egzamino);
fprintf(frw, '\n Studentu neislaikiusiu sio egzamino numeriai: \n');
fprintf(frw,'%6.2f', neislaike_egzo);
fclose(frw);