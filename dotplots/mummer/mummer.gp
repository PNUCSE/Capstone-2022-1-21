set terminal postscript color solid "Courier" 8
set output "mummer.ps"
set size 1,1
set grid
set nokey
set border 0
set tics scale 0
set xlabel "REF"
set ylabel "H_pyloriJ99_Eslice"
set format "%.0f"
set xrange [1:*]
set yrange [1:*]
set linestyle 1  lt 1 lw 2 pt 6 ps 0.5
set linestyle 2  lt 3 lw 2 pt 6 ps 0.5
set linestyle 3  lt 2 lw 2 pt 6 ps 0.5
plot \
 "mummer.fplot" title "FWD" w lp ls 1, \
 "mummer.rplot" title "REV" w lp ls 2
