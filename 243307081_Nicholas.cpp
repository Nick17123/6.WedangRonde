#include <iostream>
#include <iomanip>
#include <stdio.h>

using namespace std;

 int main() 
{	const int j = 5;
 	string nip[j], nama[j], jk[j], tmpt[j], bulan[j], alamat[j], jabatan[j], nohp[j], status[j];
 	string nama_pasangan[j];
 	int tgl[j], thn[j], jumlah_anak[j] = {0};
 	double gaji_pokok[j] = {0}, tunjangan_pasangan[j] = {0}, tunjangan_anak[j] = {0}, total_gaji[j] = {0};
 	 
 for (int i = 0; i < j; i++)
 {	cout << "\n\t\t\t\t INPUT BIODATA KARYAWAN " << i + 1 << "\n";
    cout << "MASUKKAN NIP KARYAWAN\t\t\t\t: ";
    cin >> nip[i];
    cout << "MASUKKAN NAMA KARYAWAN\t\t\t\t: ";
    cin.ignore(); 
	getline(cin, nama[i]);
    cout << "MASUKKAN JENIS KELAMIN KARYAWAN\t\t\t: ";
    cin >> jk[i];
    cout << "MASUKKAN TEMPAT TANGGAL LAHIR KARYAWAN\t\t: ";
    cin >> tmpt[i] >> tgl[i] >> bulan[i] >> thn[i];
    cout << "MASUKKAN ALAMAT KARYAWAN\t\t\t: ";
    cin.ignore(); 
    getline(cin, alamat[i]);
    cout << "MASUKKAN JABATAN KARYAWAN\t\t\t: ";
    getline(cin, jabatan[i]);
    cout << "MASUKKAN NOMOR HANDPHONE KARYAWAN\t\t: ";
    cin >> nohp[i];
    cout << "MASUKKAN STATUS KARYAWAN (1. Belum Menikah / 2. Menikah): ";
    cin >> status[i];
 if (status[i] == "2")
{
    cout << "MASUKKAN NAMA PASANGAN\t\t\t\t: ";
    cin.ignore(); 
    getline(cin, nama_pasangan[i]);
    cout << "MASUKKAN JUMLAH ANAK\t\t\t\t: ";
    cin >> jumlah_anak[i];
}
if (jabatan[i] == "Manajer","manajer") { gaji_pokok[i] = 14000000; }
else if (jabatan[i] == "Supervisor","supervisor") { gaji_pokok[i] = 7300000; }
else if (jabatan[i] == "Karyawan","karyawan") { gaji_pokok[i] = 5000000; }
else { cout << "Input data salah.\n"; return 1; }

if (status[i] == "2") { tunjangan_pasangan[i] = 0.02 * gaji_pokok[i]; tunjangan_anak[i] = 0.015 * gaji_pokok[i] * jumlah_anak[i]; }
	total_gaji[i] = gaji_pokok[i] + tunjangan_pasangan[i] + tunjangan_anak[i];
}

 for (int i = 0; i < j; i++)
{
	cout << "\n\t\t\t\t OUTPUT BIODATA KARYAWAN " << i + 1 << "\n";
    cout << "NIP KARYAWAN\t\t\t\t\t\t: " << nip[i] << endl;
    cout << "NAMA KARYAWAN\t\t\t\t\t\t: " << nama[i] << endl;
    cout << "JENIS KELAMIN\t\t\t\t\t\t: " << jk[i] << endl;
    cout << "TEMPAT TANGGAL LAHIR\t\t\t\t\t: " << tmpt[i] << " " << tgl[i] << " " << bulan[i] << " " << thn[i] << endl;
    cout << "ALAMAT KARYAWAN\t\t\t\t\t\t: " << alamat[i] << endl;
    cout << "JABATAN KARYAWAN\t\t\t\t\t: " << jabatan[i] << endl;
    cout << "NOMOR HANDPHONE KARYAWAN\t\t\t\t: " << nohp[i] << endl;
	cout << "STATUS KARYAWAN\t\t\t\t\t\t: " << (status[i] == "2" ? "Menikah" : "Belum Menikah") << endl;
	
if (status[i] == "2") 
{
    cout << "NAMA PASANGAN\t\t\t\t\t: " << nama_pasangan[i] << endl;
    cout << "JUMLAH ANAK\t\t\t\t\t: " << jumlah_anak[i] << endl;
}
	cout << fixed << setprecision(0); 
    cout.imbue(locale("")); 

    cout << "GAJI POKOK\t\t\t\t\t: Rp. " << gaji_pokok[i] << endl;
    cout << "TUNJANGAN PASANGAN\t\t\t\t: Rp. " << tunjangan_pasangan[i] << endl;
    cout << "TUNJANGAN ANAK\t\t\t\t\t: Rp. " << tunjangan_anak[i] << endl;
    cout << "TOTAL GAJI\t\t\t\t\t: Rp. " << total_gaji[i] << endl;
    
}
return 0;
}
