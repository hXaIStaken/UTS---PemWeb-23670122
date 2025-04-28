package main

import (
	"fmt"
	"html/template"
	"net/http"
	"strconv"
)

type Obat struct {
	ID                int
	NamaObat          string
	TanggalProduksi   string
	TanggalExpired    string
	PerusahaanFarmasi string
	Deskripsi         string
}

var dataObat []Obat
var idCounter = 1

func main() {
	http.HandleFunc("/", listObat)
	http.HandleFunc("/create", createObat)
	http.HandleFunc("/edit", editObat)
	http.HandleFunc("/delete", deleteObat)

	fmt.Println("Server running at http://localhost:8080/")
	http.ListenAndServe(":8080", nil)
}

func listObat(w http.ResponseWriter, r *http.Request) {
	tmpl := template.Must(template.New("list").Parse(`
		<h1>Data Obat</h1>
		<a href='/create'>Tambah Obat</a>
		<table border='1'>
		<tr><th>ID</th><th>Nama</th><th>Tgl Produksi</th><th>Tgl Expired</th><th>Perusahaan</th><th>Deskripsi</th><th>Action</th></tr>
		{{range .}}
		<tr>
		<td>{{.ID}}</td>
		<td>{{.NamaObat}}</td>
		<td>{{.TanggalProduksi}}</td>
		<td>{{.TanggalExpired}}</td>
		<td>{{.PerusahaanFarmasi}}</td>
		<td>{{.Deskripsi}}</td>
		<td><a href='/edit?id={{.ID}}'>Edit</a> | <a href='/delete?id={{.ID}}'>Delete</a></td>
		</tr>
		{{end}}
		</table>
	`))
	tmpl.Execute(w, dataObat)
}

func createObat(w http.ResponseWriter, r *http.Request) {
	if r.Method == "POST" {
		nama := r.FormValue("nama")
		tglProd := r.FormValue("tgl_produksi")
		tglExp := r.FormValue("tgl_expired")
		perusahaan := r.FormValue("perusahaan")
		deskripsi := r.FormValue("deskripsi")

		dataObat = append(dataObat, Obat{
			ID:                idCounter,
			NamaObat:          nama,
			TanggalProduksi:   tglProd,
			TanggalExpired:    tglExp,
			PerusahaanFarmasi: perusahaan,
			Deskripsi:         deskripsi,
		})
		idCounter++
		http.Redirect(w, r, "/", http.StatusSeeOther)
		return
	}
	tmpl := template.Must(template.New("form").Parse(`
		<h1>Tambah Obat</h1>
		<form method='POST'>
		Nama Obat: <input name='nama'><br>
		Tanggal Produksi: <input name='tgl_produksi'><br>
		Tanggal Expired: <input name='tgl_expired'><br>
		Perusahaan Farmasi: <input name='perusahaan'><br>
		Deskripsi: <textarea name='deskripsi'></textarea><br>
		<button type='submit'>Simpan</button>
		</form>
	`))
	tmpl.Execute(w, nil)
}

func editObat(w http.ResponseWriter, r *http.Request) {
	idStr := r.URL.Query().Get("id")
	id, _ := strconv.Atoi(idStr)
	var obat *Obat
	for i := range dataObat {
		if dataObat[i].ID == id {
			obat = &dataObat[i]
			break
		}
	}
	if obat == nil {
		http.NotFound(w, r)
		return
	}
	if r.Method == "POST" {
		obat.NamaObat = r.FormValue("nama")
		obat.TanggalProduksi = r.FormValue("tgl_produksi")
		obat.TanggalExpired = r.FormValue("tgl_expired")
		obat.PerusahaanFarmasi = r.FormValue("perusahaan")
		obat.Deskripsi = r.FormValue("deskripsi")
		http.Redirect(w, r, "/", http.StatusSeeOther)
		return
	}
	tmpl := template.Must(template.New("formEdit").Parse(`
		<h1>Edit Obat</h1>
		<form method='POST'>
		Nama Obat: <input name='nama' value='{{.NamaObat}}'><br>
		Tanggal Produksi: <input name='tgl_produksi' value='{{.TanggalProduksi}}'><br>
		Tanggal Expired: <input name='tgl_expired' value='{{.TanggalExpired}}'><br>
		Perusahaan Farmasi: <input name='perusahaan' value='{{.PerusahaanFarmasi}}'><br>
		Deskripsi: <textarea name='deskripsi'>{{.Deskripsi}}</textarea><br>
		<button type='submit'>Update</button>
		</form>
	`))
	tmpl.Execute(w, obat)
}

func deleteObat(w http.ResponseWriter, r *http.Request) {
	idStr := r.URL.Query().Get("id")
	id, _ := strconv.Atoi(idStr)
	for i := range dataObat {
		if dataObat[i].ID == id {
			dataObat = append(dataObat[:i], dataObat[i+1:]...)
			break
		}
	}
	http.Redirect(w, r, "/", http.StatusSeeOther)
}
