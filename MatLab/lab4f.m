## Copyright (C) 2020 ASUS
## 
## This program is free software: you can redistribute it and/or modify it
## under the terms of the GNU General Public License as published by
## the Free Software Foundation, either version 3 of the License, or
## (at your option) any later version.
## 
## This program is distributed in the hope that it will be useful, but
## WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
## GNU General Public License for more details.
## 
## You should have received a copy of the GNU General Public License
## along with this program.  If not, see
## <https://www.gnu.org/licenses/>.

## -*- texinfo -*- 
## @deftypefn {} {@var{retval} =} lab4f (@var{input1}, @var{input2})
##
## @seealso{}
## @end deftypefn

## Author: ASUS <ASUS@DESKTOP-VK5RES6>
## Created: 2020-11-09
%Dovydas Kasiliauskis 4 laboratorinis darbas 10 variantas

function [Xs,suma,Xvid,X,C,maz,indexmin] = lab4f (X);
  %Skaiciuojamas masyvo X vidurkis ir randamas C masyvas
  suma=0;
  Xs=size(X,2);
  for i=1:1:Xs
    suma=suma+X(i);
  end
  Xvid=suma/Xs;
  for i=1:1:Xs
    if (X(i)>Xvid)
      C(i)=X(i);

    end
  end
  %Randamas maziausias masyvo C elementas ir jo indeksas

indexmin=find(C==min(C));
C(indexmin)=[];
maz= min(C);







  

endfunction


