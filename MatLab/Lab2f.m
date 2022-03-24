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
## @deftypefn {} {@var{retval} =} Lab2f (@var{input1}, @var{input2})
##
## @seealso{}
## @end deftypefn

## Author: ASUS <ASUS@DESKTOP-VK5RES6>
## Created: 2020-12-07
%Darba atliko Dovydas Kasiliauskis PS-0/2 grupe, 10 variantas
function [turis1,turis2,turis] = Lab2f (a, b, c, a1, b1, c1)
turis1 = a * b * c; %Bendras figuros turis jeigu nebutu iskirptas vidurys
turis2 = a1 * b1 * c1;%Iskirpties turis
turis = turis1 - turis2; %Figuros turis (is bendro turio pasalinamas iskirpties turis)
endfunction
