import api from './api.js'

const adminService = {
  // Dashboard
  async getDashboard() {
    const res = await api.get('/admin/dashboard')
    return res.data
  },

  // Users
  async getUsers() {
    const res = await api.get('/admin/users')
    return res.data
  },

  async deleteUser(id) {
    const res = await api.delete(`/admin/users/${id}`)
    return res.data
  },

  // Tiket
  async getTiket() {
    const res = await api.get('/admin/tiket')
    return res.data
  },

  async updateTiket(id, data) {
    const res = await api.put(`/admin/tiket/${id}`, data)
    return res.data
  },

  // Wahana
  async getWahana() {
    const res = await api.get('/admin/wahana')
    return res.data
  },

  async createWahana(data) {
    const res = await api.post('/admin/wahana', data)
    return res.data
  },

  async updateWahana(id, data) {
    const res = await api.put(`/admin/wahana/${id}`, data)
    return res.data
  },

  async deleteWahana(id) {
    const res = await api.delete(`/admin/wahana/${id}`)
    return res.data
  },

  // Review
  async getReview() {
    const res = await api.get('/admin/review')
    return res.data
  },

  async deleteReview(id) {
    const res = await api.delete(`/admin/review/${id}`)
    return res.data
  },
}

export default adminService