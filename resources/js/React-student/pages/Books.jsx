import React from 'react'

const Books = ({ user }) => {
  return (
    <div>
      <h1>Books</h1>
      <p>User: {user.name}</p>
    </div>
  )
}

export default Books